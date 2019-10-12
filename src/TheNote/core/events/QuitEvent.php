<?php

namespace TheNote\core\events;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\utils\Config;
use TheNote\core\Main;

class QuitEvent implements Listener
{
    public function __construct(Main $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onQuit(PlayerQuitEvent $event)
    {
        $player = $event->getPlayer();
        $name = $player->getName();

        $config = new Config($this->plugin->getDataFolder() . "players/" . strtolower($name) . ".yml");
        $nickname = $config->get("Nickname");
        $event->setQuitMessage("§f[§c-§f] §e$nickname");
    }
}