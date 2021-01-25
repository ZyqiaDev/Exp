<?php

namespace exp\commands;

use exp\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class SetExpCommand extends Command
{
	private $main;

	function __construct(Main $main)
	{
		parent::__construct("setexp", "Remove experience from a player #Exp", null, ["setxp"]);
		$this->setPermission("setexp.command");
		$this->main = $main;
	}

	public function execute(CommandSender $s, string $commandLabel, array $args): bool
	{
		if($s->hasPermission("setexp.command")) {
			if ($s instanceof Player) {
				if (count($args) <= 0) {
					$s->sendMessage("§b§lExp Usage§r§o§8» §r§c/setxp (amount) (player)");
				}
				if (count($args) == 1) {
					$s->setXpLevel($args[0]);
					$s->sendMessage("§b§lExp §r§o§8» §r§gYou have set your exp level to §b$args[0]");
				}
				if (count($args) >= 2) {
					$p = $this->main->getServer()->getPlayer($args[1]);
					if ($p !== null) {
						$p->setXpLevel($args[0]);
						$p->sendMessage("§b§lExp §r§o§8» §r§gSomeone has set your exp level to §b$args[0]");
						$s->sendMessage("§b§lExp §r§o§8» §r§gYou have set §b" . $p->getDisplayName() . " §gexp level to §b$args[0]");
					} else {
						$s->sendMessage("§b§lExp §r§o§8» §r§cPlayer not online");
					}
				}
			}
		}
		return true;
	}
}