<?php

namespace exp;

use exp\commands\AddExpCommand;
use exp\commands\MyExpCommand;
use exp\commands\RemoveExpCommand;
use exp\commands\SellExpCommand;
use exp\commands\SetExpCommand;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase
{
	function onEnable()
	{
		$this->getLogger()->info("§o§bExp §8» §2Enabled");
		@mkdir($this->getDataFolder());
		$this->saveDefaultConfig();
		$this->registerCommands();
	}

	function registerCommands()
	{
		$this->getServer()->getCommandMap()->register("addexp", new AddExpCommand($this));
		$this->getServer()->getCommandMap()->register("myexp", new MyExpCommand($this));
		$this->getServer()->getCommandMap()->register("removeexp", new RemoveExpCommand($this));
		if($this->getConfig()->get("Economics") == "Enabled") {
			$this->getServer()->getCommandMap()->register("sellexp", new SellExpCommand($this));
		}
		$this->getServer()->getCommandMap()->register("setexp", new SetExpCommand($this));
	}

	function onDisable()
	{
		$this->getLogger()->info("§o§bExp §8» §cDisabled");
		$this->saveConfig();
	}
}
