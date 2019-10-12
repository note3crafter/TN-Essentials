<?php

namespace TheNote\core\command;

use TheNote\core\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;

class KreativCommand extends Command {

    public function __construct(Main $plugin){
        parent::__construct("gmc", Main::$prefix . "Setzt den Spielmodus auf §aKreativ", "/gmc", ["gm1"]);
        $this->setPermission("tnessentials.command.creativ");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if (!$this->testPermission($sender)){
            return false;
        }

        if ($sender instanceof Player){
            if ($sender->hasPermission("tnessentials.command.creativ") || $sender->isOp()) {
                $sender->setGamemode(1);
                $sender->sendMessage(Main::$prefix . "Du bist nun im §aKreativ §6modus.");
            }
        }
        return false;
    }
}