<?php

namespace TheNote\core\listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\Config;
use TheNote\core\Main;

class MainListener implements Listener
{

    public function __construct(Main $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onJoin(PlayerJoinEvent $event)
    {
        $player = $event->getPlayer();
        $name = $player->getName();

        $config = new Config($this->plugin->getDataFolder() . "players/" . strtolower($name) . ".yml");
        $nickname = $config->get("Nickname");
        $player->setDisplayName($nickname);
        $player->setNameTag($nickname);

        if (!file_exists($this->plugin->getDataFolder() . "players/" . strtolower($name) . ".yml")) {
            $config = new Config($this->plugin->getDataFolder() . "players/" . strtolower($name) . ".yml");
            $config->set("Nickname", "$name");
            $config->save();
        }
    }
}