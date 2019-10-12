<?php

namespace TheNote\core\command;

use TheNote\core\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;

class SurvivalCommand extends Command {

    public function __construct(Main $plugin){
        parent::__construct("gms", Main::$prefix . "Setzt den Spielmodus auf §aÜberleben", "/gms", ["gm0", "survival"]);
        $this->setPermission("tnessentials.command.survival");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if (!$this->testPermission($sender)){
            return false;
        }

        if ($sender instanceof Player){
            if ($sender->hasPermission("tnessentials.command.survival") || $sender->isOp()) {
                $sender->setGamemode(0);
                $sender->sendMessage(Main::$prefix . "Du bist nun im §aÜberlebens §6modus.");
            }
        }
        return false;
    }
}