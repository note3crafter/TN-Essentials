<?php

namespace TheNote\core;

use pocketmine\plugin\PluginBase;

use TheNote\core\command\DayCommand;
use TheNote\core\command\NickCommand;
use TheNote\core\command\NightCommand;
use TheNote\core\command\FeedCommand;
use TheNote\core\command\HealCommand;
use TheNote\core\command\SurvivalCommand;
use TheNote\core\command\KreativCommand;
use TheNote\core\command\AbenteuerCommand;
use TheNote\core\command\ChatClearCommand;
use TheNote\core\command\ZuschauerCommand;
use TheNote\core\command\FlyCommand;
use TheNote\core\command\VanishCommand;
use TheNote\core\command\PayallCommand;

use TheNote\core\events\QuitEvent;
use TheNote\core\events\JoinEvent;
use TheNote\core\events\VanishEvent;

use TheNote\core\listener\MainListener;

class Main extends PluginBase {

    public static $prefix = "§f[§4T§fN] §6";

    public static $instance;
    public $vanish = [];

    public function onEnable(){
        self::$instance = $this;
        @mkdir($this->getDataFolder());

		$this->getServer()->getPluginManager()->registerEvents(new MainListener($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new JoinEvent($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new QuitEvent($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new VanishEvent($this), $this);
        $this->getServer()->getCommandMap()->register("payall", new PayallCommand($this));
        $this->getServer()->getCommandMap()->register("nick", new NickCommand($this));
        $this->getServer()->getCommandMap()->register("day", new DayCommand($this));
		$this->getServer()->getCommandMap()->register("night", new NightCommand($this));
		$this->getServer()->getCommandMap()->register("feed", new FeedCommand($this));
		$this->getServer()->getCommandMap()->register("heal", new HealCommand($this));
		$this->getServer()->getCommandMap()->register("gms", new SurvivalCommand($this));
		$this->getServer()->getCommandMap()->register("gmc", new KreativCommand($this));
		$this->getServer()->getCommandMap()->register("gma", new AbenteuerCommand($this));
		$this->getServer()->getCommandMap()->register("gmspc", new ZuschauerCommand($this));
        $this->getServer()->getCommandMap()->register("chatclear", new ChatClearCommand($this));
        $this->getServer()->getCommandMap()->register("fly", new FlyCommand($this));
        $this->getServer()->getCommandMap()->register("vanish", new VanishCommand($this));
        $this->getServer()->getCommandMap()->register("nick", new NickCommand($this));
    }
}