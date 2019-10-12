<?php

namespace TheNote\core\command;

use TheNote\core\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class DayCommand extends Command {

    public function __construct(Main $plugin){
        parent::__construct("day", Main::$prefix . "Setzt die Zeit auf §bTag", "/day", ["tag"]);
        $this->setPermission("tnessentials.command.day");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if (!$this->testPermission($sender)){
            return false;
        }

        if ($sender instanceof Player){
            if ($sender->hasPermission("tnessentials.command.day") || $sender->isOp()) {
                $sender->getLevel()->setTime(0);
                $sender->sendMessage(Main::$prefix . "Du hast die Zeit auf ist §bTag§6 §6gestellt.");
            }
        }
        return false;
    }
}