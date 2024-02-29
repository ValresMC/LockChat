<?php

namespace Valres\LockChat\manager;

class LockChatManager
{
    /** @var bool */
    public bool $lock = false;

    /**
     * Set if chat is lock or not.
     * @param bool $lock
     * @return void
     */
    public function setLock(bool $lock): void
    {
        $this->lock = $lock;
    }

    /**
     * Return if chat is lock or not.
     * @return bool
     */
    public function isLock(): bool
    {
        return $this->lock;
    }
}
