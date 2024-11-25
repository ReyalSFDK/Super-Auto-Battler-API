<?php

namespace App\Service;

class BattleActionsService
{
	private array $actions = [];

	public function registerAttackAction(
		string $playerCharacterId,
		string $enemyCharacterId,
		int $playerDamageReceived,
		int $enemyDamageReceived
	): void
	{
		$this->actions[] = [
			'type' => 'ATTACK',
			'playerCharacterId' => $playerCharacterId,
			'enemyCharacterId' => $enemyCharacterId,
			'playerDamageReceived' => $playerDamageReceived,
			'enemyDamageReceived' => $enemyDamageReceived,
		];
	}

	public function getActions(): array
	{
		return $this->actions;
	}
}