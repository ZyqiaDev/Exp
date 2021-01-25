<?php

namespace exp\commands;

use exp\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class MyExpCommand extends Command
{
	private $main;

	function __construct(Main $main)
	{
		parent::__construct("myexp", "Displays how much experience you have #Exp", null, ["myxp"]);
		$this->main = $main;
	}

	public function execute(CommandSender $s, string $commandLabel, array $args): bool
	{
		if ($s instanceof Player) {
			if (count($args) >= 0) {
				$exp = $s->getXpLevel();
				$s->sendMessage("§b§lExp §r§o§8» §r§gYour total exp level: §b$exp");
			}
		}
		return true;
	}
}