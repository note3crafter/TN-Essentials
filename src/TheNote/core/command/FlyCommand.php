<?php

namespace TheNote\core\command;

use TheNote\core\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class FlyCommand extends Command
{

    public function __construct(Main $plugin)
    {
        parent::__construct("fly", Main::$prefix . "§aAktiviert§f/§cDeaktiviert§6 Fliegen", "/fly", ["fliegen"]);
        $this->setPermission("tnessentials.command.fly");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$this->testPermission($sender)) {
            return false;
        }

        if ($sender instanceof Player) {
            if ($sender->hasPermission("tnessentials.command.fly") || $sender->isOp()) {
                if ($sender->getAllowFlight() === true){
                    $sender->setAllowFlight(false);
                    $sender->setFlying(false);
                    $sender->sendMessage(Main::$prefix . "Dein §eFlugmodus §6wurde §cDeaktiviert§6.");
                } else {
                    $sender->setAllowFlight(true);
                    $sender->setFlying(true);
                    $sender->sendMessage(Main::$prefix . "Dein §eFlugmodus §6wurde §aAktiviert§6.");
                }
            }
            return true;
        }
    }
}