<?php

namespace Valres\LockChat;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use Valres\LockChat\command\LockCommand;
use Valres\LockChat\listener\PlayerChat;
use Valres\LockChat\manager\LockChatManager;

class Main extends PluginBase
{
    public LockChatManager $manager;

    use SingletonTrait;

    protected function onEnable(): void
    {
        $this->getLogger()->info("by Valres is ready ! .gg/highcraft");
        $this->saveDefaultConfig();

        $this->manager = new LockChatManager();

        $this->getServer()->getCommandMap()->register("lock", new LockCommand());
        $this->getServer()->getPluginManager()->registerEvents(new PlayerChat(), $this);
    }

    protected function onLoad(): void
    {
        self::setInstance($this);
    }
}
