<?php

namespace TheNote\core\command;

use TheNote\core\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;

class AbenteuerCommand extends Command {

    public function __construct(Main $plugin){
        parent::__construct("gma", Main::$prefix . "Setzt den Spielmodus auf §aAbenteuer", "/gma", ["abenteuer", "gm2"]);
        $this->setPermission("tnessentials.command.adventure");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if (!$this->testPermission($sender)){
            return false;
        }

        if ($sender instanceof Player){
            if ($sender->hasPermission("tnessentials.command.adventure") || $sender->isOp()) {
                $sender->setGamemode(2);
                $sender->sendMessage("§f[§4N§fL] §6Du bist nun im §aAbenteuer §6modus.");
            }
        }
        return false;
    }
}