<?php
namespace TheNote\core\command;

use TheNote\core\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;

class HealCommand extends Command {

    public function __construct(Main $plugin){
        parent::__construct("heal", Main::$prefix . "Heilt dich", "/heal");
        $this->setPermission("tnessentials.command.heal");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if (!$this->testPermission($sender)){
            return false;
        }

        if ($sender instanceof Player){
            if ($sender->hasPermission("tnessentials.command.day") || $sender->isOp()) {
                $sender->setHealth(20);
                $sender->sendMessage(Main::$prefix . "Du wurdest §eGeheilt§6.");
            }
        }
        return false;
    }
}