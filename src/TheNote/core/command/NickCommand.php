<?php

namespace TheNote\core\command;

use TheNote\core\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;

class NickCommand extends Command {

    public function __construct(Main $plugin){
        parent::__construct("nick", Main::$prefix . "Ändere dein §eNickname", "/nick <Name>");
        $this->setPermission("noteland.command.nick");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        $name = $sender->getName();

        if (!$this->testPermission($sender)){
            return false;
        }

        if (empty($args[0])){
            $sender->sendMessage(Main::$prefix . "§cBitte benutze /nick <name>");
            return true;
        }

        $name = $args[0];

        $sender->setDisplayName($name);
        $sender->setNameTag($name);

        $config = new Config($this->plugin->getDataFolder(). "players/" . strtolower($name) .".yml", Config::YAML);
        $config->set("Nickname", "$name");
        $config->save();
        $sender->sendMessage(Main::$prefix . "Du hast deinen Nicknamen zu §e$name §6geändert!");

        return false;
    }
}