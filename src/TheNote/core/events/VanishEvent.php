<?php

namespace TheNote\core\events;

use TheNote\core\Main;
use TheNote\core\Scheduler\VanishScheduler;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class VanishEvent implements Listener{
    private $plugin;

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }
    public function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        $this->plugin->vanish[$player->getName()] = false;
        $this->plugin->getScheduler()->scheduleDelayedTask(new VanishScheduler($this->plugin, $player->getPlayer()), 1);
    }
    public function onQuit(PlayerQuitEvent $event){
        $player = $event->getPlayer();
        $this->plugin->vanish[$player->getName()] = false;
    }
}