<?php

namespace TheNote\core\command;

use TheNote\core\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class FeedCommand extends Command {

    public function __construct(Main $plugin){
        parent::__construct("feed", Main::$prefix . "Stillt dein Hunger", "/feed", ["essen"]);
        $this->setPermission("tnessentials.command.feed");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if (!$this->testPermission($sender)){
            return false;
        }

        if ($sender instanceof Player){
            if ($sender->hasPermission("tnessentials.command.feed") || $sender->isOp()) {
                $sender->setAllowFlight(true);
                $sender->setFood(20);
                $sender->sendMessage(Main::$prefix . "Dein §eHunger §6wurde gestillt.");
            }
        }
        return false;
    }
}