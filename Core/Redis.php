<?php

namespace Hitek\Slimez\Payments\Core;

use \Predis\Client;

/**
 * Author: Oaad Global
 * Developer: Hitek Financials Ltd
 * Year: 2024
 * Developer Contact: contact@tekfinancials.ng, kennethusiobaifo@yahoo.com
 * Project Name: Slimez
 * Description: Slimez.
 */

/**
 * Class Redis
 *
 * This class extends the Predis\Client class and provides additional methods for working with Redis cache.
 */
class Redis extends Client
{
    /**
     * Initialize a Redis instance.
     *
     * @return Redis The initialized Redis instance.
     */
    public static function init(): self
    {
        return new static();
    }

    /**
     * Set a key-value pair in the Redis cache.
     *
     * @param string $key The key.
     * @param mixed $value The value.
     * @param int|null $timeout The cache timeout in seconds.
     * @return void
     */
    public function setRedis(string $key, mixed $value, int $timeout = null)
    {
        if (!empty($key) && !empty($value)) {
            if ($timeout == null) {
                $this->set($key, $value);
                return;
            }
            $this->set($key, $value, $timeout);
            return;
        }
    }

    /**
     * Get the value associated with a key from the Redis cache.
     *
     * @param string $key The key.
     * @return mixed|null The value associated with the key, or null if the key does not exist.
     */
    public function getRedis(string $key)
    {
        if (!empty($key)) {
            return $this->get($key);
        }
    }

    /**
     * Delete a key from the Redis cache.
     *
     * @param mixed $key The key to delete.
     * @return int The number of keys deleted.
     */
    public function deleteRedis($key)
    {
        if (!empty($key)) {
            return $this->del($key);
        }
    }

    /**
     * Ping the Redis server to check its availability.
     *
     * @return string The PONG response from the server.
     */
    public function pingRedis()
    {
        return $this->ping();
    }

    /**
     * Flush all data from the Redis cache.
     *
     * @return string The response from the server.
     */
    public function destroyRedis()
    {
        return $this->flushall();
    }
}
