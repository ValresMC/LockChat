<?php

namespace Valres\LockChat\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\Permission;
use pocketmine\permission\PermissionManager;
use pocketmine\Server;
use Valres\LockChat\Main;

class LockCommand extends Command
{
    public function __construct()
    {
        $commandConfig = Main::getInstance()->getConfig()->get("lock-command");
        parent::__construct(
            $commandConfig["name"],
            $commandConfig["description"],
            $commandConfig["usage"],
            $commandConfig["aliases"]
        );
        $this->setPermission("lock.command");
        $this->setPermissionMessage($commandConfig["permission-message"]);

    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void
    {
        $manager = Main::getInstance()->manager;
        $config = Main::getInstance()->getConfig();

        switch($manager->isLock())
        {
            default:
                $message = "";
                break;
            case true:
                $manager->setLock(false);
                $message = $config->get("unlock-message");
                break;

            case false:
                $manager->setLock(true);
                $message = $config->get("lock-message");
                break;
        }
        Server::getInstance()->broadcastMessage(str_replace(
            "{PLAYER}",
            $sender->getName(),
            $message
        ));
    }
}
