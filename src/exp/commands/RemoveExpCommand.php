<?php

namespace exp\commands;

use exp\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class RemoveExpCommand extends Command
{
	private $main;

	function __construct(Main $main)
	{
		parent::__construct("removeexp", "Remove experience from a player #Exp", null, ["removexp", "subexp"]);
		$this->setPermission("removeexp.command");
		$this->main = $main;
	}

	public function execute(CommandSender $s, string $commandLabel, array $args): bool
	{
		if($s->hasPermission("removeexp.command")) {
			if ($s instanceof Player) {
				if (count($args) <= 0) {
					$s->sendMessage("§b§lExp Usage§r§o§8» §r§c/removeexp (amount) (player)");
				}
				if (count($args) == 1) {
					if ($args[0] < $s->getXpLevel()) {
						$s->subtractXpLevels($args[0]);
						$s->sendMessage("§b§lExp §r§o§8» §r§gYou removed §b$args[0] §gexp levels from yourself");
					} else {
						$s->sendMessage("§b§lExp §r§o§8» §r§gYou dont have enough exp levels to remove");
					}
				}
				if (count($args) >= 2) {
					$p = $this->main->getServer()->getPlayer($args[1]);
					if ($args[0] < $s->getXpLevel()) {
						if ($p !== null) {
							$p->subtractXpLevels($args[0]);
							$p->sendMessage("§b§lExp §r§o§8» §r§gSomeone has removed §b$args[0] §gexp levels from you");
							$s->sendMessage("§b§lExp §r§o§8» §r§gYou removed §b$args[0] §gexp levels from §b" . $p->getDisplayName());
						} else {
							$s->sendMessage("§b§lExp §r§o§8» §r§cPlayer not online");
						}
					} else {
						$s->sendMessage("§b§lExp §r§o§8» §r§b" . $this->main->getServer()->getPlayer($args[1])->getDisplayName() . " §gdoes not have enough exp levels to remove");
					}
				}
			}
		}
		return true;
	}
}