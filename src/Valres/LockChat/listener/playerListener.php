<?php

namespace Valres\LockChat\listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use Valres\LockChat\command\lockCommand;
use Valres\LockChat\Main;

class playerListener implements Listener
{
    public function __construct(public Main $plugin) {}

    public function onChat(PlayerChatEvent $event): void
    {
        $player = $event->getPlayer();
        $config = $this->plugin->config("config");

        if(lockCommand::isLock()){
            $player->sendMessage($config->get("lock-chat"));
            $event->cancel();
        }
    }
}