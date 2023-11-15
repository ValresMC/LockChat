<?php

namespace Valres\LockChat\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use Valres\LockChat\Main;

final class lockCommand extends Command
{
    private static bool $lock = false;

    public function __construct(public Main $plugin)
    {
        parent::__construct("lock", "§7Permet de lock le chat !");
        $this->setPermission("lock.command");
        $this->setPermissionMessage("§cVous n'avez pas la permission de lock le chat !");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     * @return void
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): void
    {
        if($sender->hasPermission("lock.command"))
        {
            $config = $this->plugin->config("config");

            if(self::$lock === false) {
                self::$lock = true;
                $sender->sendMessage($config->get("lock-success"));
                Server::getInstance()->broadcastMessage(str_replace("{user}", $sender->getName(), $config->get("lock-message")));
            } else {
                self::$lock = false;
                $sender->sendMessage($config->get("unlock-success"));
                Server::getInstance()->broadcastMessage(str_replace("{user}", $sender->getName(), $config->get("unlock-message")));
            }
        } else $sender->sendMessage($this->getPermissionMessage());
    }

    public static function isLock(): bool
    {
        return self::$lock;
    }

}
