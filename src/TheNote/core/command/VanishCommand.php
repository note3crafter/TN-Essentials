<?php

namespace TheNote\core\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use TheNote\core\Main;
use pocketmine\Player;

class VanishCommand extends Command{

    private $plugin;

    function __construct(Main $plugin){

        $this->plugin = $plugin;

        parent::__construct("vanish", Main::$prefix . "§aAktiviert§f/§cDeaktiviert§6 Vanish", "/vanish", ["v"]);
        $this->setPermission("tnessentials.command.vanish");
    }
    function execute(CommandSender $sender, string $commandLabel, array $args){
        if($sender instanceof Player){
            if ($sender->hasPermission("tnessentials.command.vanish") || $sender->isOp()) {
                if($this->plugin->vanish[$sender->getName()] === false){
                    $sender->sendMessage(Main::$prefix . "Dein Vanish wurde §aAktiviert");
                    foreach ($this->plugin->getServer()->getOnlinePlayers() as $onlinePlayer){
                        $onlinePlayer->hidePlayer($sender);
                    }
                    $this->plugin->vanish[$sender->getName()] = true;
                } else {
                    $sender->sendMessage(Main::$prefix . "Dein Vanish wurde §cDeaktiviert");
                    foreach ($this->plugin->getServer()->getOnlinePlayers() as $onlinePlayer){
                        $onlinePlayer->showPlayer($sender);
                    }
                    $this->plugin->vanish[$sender->getName()] = false;
                }
            }
        }
    }
}