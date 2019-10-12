<?php

namespace TheNote\core\command;

use TheNote\core\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;

class NightCommand extends Command {

    public function __construct(Main $plugin){
        parent::__construct("night", Main::$prefix . "Setzt die Zeit auf §9Nacht", "/night", ["nacht"]);
        $this->setPermission("tnessentials.command.night");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if (!$this->testPermission($sender)){
            return false;
        }

        if ($sender instanceof Player){
            if ($sender->hasPermission("tnessentials.command.night") || $sender->isOp()) {
                $sender->getLevel()->setTime(14000);
                $sender->sendMessage(Main::$prefix . "Du hast die Zeit auf §9Nacht §6gestellt.");
            }
        }
        return false;
    }
}