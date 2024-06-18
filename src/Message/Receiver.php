<?php

namespace WeWork\Message;

class Receiver
{
    /**
     * @var array
     */
    private array $receiver;

    /**
     * @param array|string $user
     * @return void
     */
    public function setUser(array|string $user): void
    {
        $this->set('touser', $user);
    }

    /**
     * @param array|string $party
     * @return void
     */
    public function setParty(array|string $party): void
    {
        $this->set('toparty', $party);
    }

    /**
     * @param array|string $tag
     * @return void
     */
    public function setTag(array|string $tag): void
    {
        $this->set('totag', $tag);
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->receiver;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    private function set(string $key, mixed $value): void
    {
        if (is_array($value)) {
            $value = implode('|', $value);
        }

        $this->receiver[$key] = $value;
    }
}
