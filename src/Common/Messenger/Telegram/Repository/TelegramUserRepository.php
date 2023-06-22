<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Telegram\Repository;

use Illuminate\Support\Facades\Redis;
use Look\Common\Exception\InvalidValueException;
use Look\Common\Exception\UserDoesNotExistsException;
use Look\Common\Messenger\Base\Exception\UserDoesNotSaveException;
use Look\Common\Messenger\Base\User\Contract\UserInterface;
use Look\Common\Messenger\Base\User\Contract\UserRepositoryInterface;
use Look\Common\Messenger\Base\User\User;
use Look\Common\Messenger\Telegram\Value\TelegramToken;
use Look\Common\Value\Id\Id;
use Predis\Client;
use RedisException;

class TelegramUserRepository implements UserRepositoryInterface
{
    protected Client $redis;

    public function __construct()
    {
        $this->redis = Redis::client();
    }

    public function saveUser(UserInterface $user): void
    {
        $data = $user->toArray();

        try {
            foreach ($data as $key => $value) {
                $pattern = $this->pattern($user->getMessengerToken()->getValue(), $key);

                if ($value) {
                    $this->redis->set($pattern, $value);
                } else {
                    $this->redis->del($pattern);
                }
            }
        } catch (RedisException $exception) {
            throw new UserDoesNotSaveException($exception->getMessage());
        }
    }

    public function getUserByMessengerToken(int|string $messengerToken): UserInterface
    {
        $pattern = $this->pattern($messengerToken);
        $keys = $this->getKeys($pattern);

        if (empty($keys)) {
            throw new UserDoesNotExistsException();
        }

        try {
            $data = [];

            foreach ($keys as $key) {
                $data[$this->getColumnName($key)] = $this->redis->get($key);
            }

            return $this->makeUser($data, $messengerToken);
        } catch (RedisException|InvalidValueException $exception) {
            throw new UserDoesNotExistsException($exception->getMessage());
        }
    }

    protected function getKeys(string $pattern): array
    {
        $keys = $this->redis->keys($pattern);

        return array_map(static fn ($key) => str_replace('look_database_', '', $key), $keys);
    }

    protected function getColumnName(string $pattern): string
    {
        $columns = explode(':', $pattern);

        return (count($columns) === 3) ? $columns[2] : '';
    }

    protected function pattern(int|string $messengerToken, string $field = '*'): string
    {
        return "telegram-user:$messengerToken:$field";
    }

    /**
     * @throws InvalidValueException
     */
    protected function makeUser(array $data, int|string $telegramToken): UserInterface
    {
        if (!isset($data['id'])) {
            throw new InvalidValueException();
        }

        return new User(
            new Id((int) $data['id']),
            new TelegramToken($telegramToken),
            $data['message_handler'] ?? null
        );
    }
}
