<?php

namespace TheNote\core\events;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\Config;
use TheNote\core\Main;

class JoinEvent implements Listener
{
    public function __construct(Main $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onjoin(PlayerJoinEvent $event)
    {
        $player = $event->getPlayer();
        $name = $player->getName();

        $config = new Config($this->plugin->getDataFolder() . "players/" . strtolower($name) . ".yml");
        $nickname = $config->get("Nickname");
        $event->setJoinMessage("§f[§a+§f] §e$nickname");
    }
}