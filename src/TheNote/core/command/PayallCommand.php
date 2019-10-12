<?php

namespace TheNote\core\command;

use onebone\economyapi\EconomyAPI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;
use TheNote\core\Main;

class PayallCommand extends Command
{
    public function __construct(Main $plugin)
    {
        parent::__construct("payall", Main::$prefix . "Verschenke dein Geld an alle Spieler auf dem Server", "/payall");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        $name = $sender->getName();
        $config = new Config($this->plugin->getDataFolder(). "players/" . strtolower($name) .".yml");
        $nickname = $config->get("Nickname");
        if (isset($args[0])) {
            if (is_numeric($args[0])) {
                $amount = $args[0];
                $anz = count($this->plugin->getServer()->getOnlinePlayers());
                $tanz = $anz - 1;
                $maxpay = $amount * $tanz;
                $mymoney = EconomyAPI::getInstance()->myMoney($sender);
                if ($maxpay <= $mymoney) {
                    foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {
                        $name = $player->getName();
                        $iname = strtolower($name);
                        EconomyAPI::getInstance()->addMoney($iname, $amount);
                        EconomyAPI::getInstance()->reduceMoney($sender, $amount);
                    }
                    $this->plugin->getServer()->broadcastMessage(Main::$prefix . "§e" . $sender->getName() . "§6 hat §c" . $maxpay . "€ §6 an alle Spieler verteilt. Jeder hat: §e" . $amount . "€§6 erhalten.");
                } else {
                    $sender->sendMessage(Main::$prefix . "§cTut mir leid du hast zu wenig Geld auf deinem Konto!");
                }
            } else {
                $sender->sendMessage(Main::$prefix . "§cDeine Eingabe war falsch bitte versuche es erneut!");
            }
        } else {
            $sender->sendMessage(Main::$prefix . "§cBitte gebe eine Summe an");
        }
    }
}
