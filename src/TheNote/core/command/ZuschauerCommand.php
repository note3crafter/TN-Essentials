<?php

namespace TheNote\core\command;

use TheNote\core\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\Config;

class ZuschauerCommand extends Command {

    public function __construct(Main $plugin){
        parent::__construct("gmspc", Main::$prefix . "Setzt den Spielmodus auf §aZuschauer", "/gmspc", ["spectator", "zuschauer", "gm3"]);
        $this->setPermission("noteland.command.spectator");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if (!$this->testPermission($sender)){
            return false;
        }

        if ($sender instanceof Player){
            if ($sender->hasPermission("tnessentials.command.spectator") || $sender->isOp()) {
                $sender->setGamemode(3);
                $sender->sendMessage(Main::$prefix . "Du bist nun im §eZuschauer §6modus.");
            }
        }
        return false;
    }
}