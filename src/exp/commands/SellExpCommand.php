<?php

namespace exp\commands;

use exp\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use onebone\economyapi\EconomyAPI;

class SellExpCommand extends Command
{
	private $main;

	function __construct(Main $main)
	{
		parent::__construct("sellexp", "Sell your experience for money #Exp", null, ["sellxp"]);
		$this->main = $main;
	}

	public function execute(CommandSender $s, string $commandLabel, array $args): bool
	{
		if ($s instanceof Player) {
			if (count($args) <= 0) {
				$s->sendMessage("§b§lExp Usage§r§o§8» §r§c/sellexp (amount)");
			}
			if (count($args) >= 1) {
				$expamount = $args[0];
				if ($expamount < $s->getXpLevel()) {
					$moneyamount = $expamount * $this->main->getConfig()->get("MoneyPerExp");
					EconomyAPI::getInstance()->addMoney($s, $moneyamount);
					$s->subtractXpLevels($args[0]);
					$s->sendMessage("§b§lExp §r§o§8» §r§gYou have sold §b$args[0] §gexp levels for $ §b$moneyamount");
				} else {
					$s->sendMessage("§b§lExp §r§o§8» §r§gYou dont have enough exp to sell you only have §b" . $s->getXpLevel());
				}
			}
		}
		return true;
	}
}