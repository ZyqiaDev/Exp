<?php

namespace exp\commands;

use exp\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class AddExpCommand extends Command
{
	private $main;

	function __construct(Main $main)
	{
		parent::__construct("addexp", "Add experience to a player #Exp", null, ["addxp"]);
		$this->setPermission("addexp.command");
		$this->main = $main;
	}

	public function execute(CommandSender $s, string $commandLabel, array $args): bool
	{
		if($s->hasPermission("addexp.command")) {
			if ($s instanceof Player) {
				if (count($args) <= 0) {
					$s->sendMessage("§b§lExp Usage§r§o§8» §r§c/addexp (amount) (player)");
				}
				if (count($args) == 1) {
					$s->addXpLevels($args[0]);
					$s->sendMessage("§b§lExp §r§o§8» §r§gYou have added §b$args[0] §gexp levels to yourself");
				}
				if (count($args) >= 2) {
					$p = $this->main->getServer()->getPlayer($args[1]);
					if ($p !== null) {
						$p->addXpLevels($args[0]);
						$p->sendMessage("§b§lExp §r§o§8» §r§gYou have been given §b$args[0] §gexp levels");
						$s->sendMessage("§b§lExp §r§o§8» §r§gYou have added §b$args[0] §gexp levels to §b" . $p->getDisplayName());
					} else {
						$s->sendMessage("§b§lExp §r§o§8» §r§cPlayer not online");
					}
				}
			}
		}
		return true;
	}
}