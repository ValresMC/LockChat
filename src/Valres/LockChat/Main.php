<?php

namespace Valres\LockChat;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;
use Valres\LockChat\command\lockCommand;
use Valres\LockChat\listener\playerListener;

class Main extends PluginBase
{
    use SingletonTrait;

    protected function onEnable(): void
    {
        self::setInstance($this);
        $this->saveDefaultConfig();
        $this->saveResource("lock.yml");
        $this->getLogger()->info("By Valres est lancé !");
        $this->getLogger()->info("https://www.github.com/ValresMC");
        $this->getServer()->getPluginManager()->registerEvents(new playerListener($this), $this);
        $this->getServer()->getCommandMap()->register("lock", new lockCommand($this));
    }

    public function config(string $file): Config
    {
        return new Config($this->getDataFolder().$file.".yml", Config::YAML);
    }


}
