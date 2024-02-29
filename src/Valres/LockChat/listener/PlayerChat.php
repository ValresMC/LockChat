<?php

namespace Valres\LockChat\listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\Server;
use Valres\LockChat\Main;

class PlayerChat implements Listener
{
    public function onPlayerChat(PlayerChatEvent $event): void
    {
        $manager = Main::getInstance()->manager;
        $config = Main::getInstance()->getConfig();
        $player = $event->getPlayer();

        if($manager->isLock() and !Server::getInstance()->isOp($player->getName())){
            $event->cancel();
            $player->sendMessage($config->get("no-message"));
        }
    }
}
