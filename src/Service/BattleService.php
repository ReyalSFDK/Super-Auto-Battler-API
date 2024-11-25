<?php

namespace App\Service;

use App\Entity\BattlerCharacter;
use App\Entity\Character;
use App\Repository\CharactersRepository;
use Exception;
use function _\find;

class BattleService
{
	/**
	 * @var BattlerCharacter[]
	 */
	private array $playerTeam = [];

	/**
	 * @var BattlerCharacter[]
	 */
	private array $enemyTeam = [];

	/**
	 * @param CharactersRepository $charactersRepository
	 * @param BattleActionsService $battleActionsService
	 */
	public function __construct(
		private readonly CharactersRepository $charactersRepository,
		private readonly BattleActionsService $battleActionsService,
	) {}

	/**
	 * Start the battle
	 *
	 * @param Character[] $playerTeam
	 * @return array Battle actions
	 */
	public function battle(
		array $playerTeam,
	): array
	{
		$enemies = $this->generateEnemies(count($playerTeam));
		$this->setupTeams($playerTeam, $enemies);

		while ($this->canContinue()) {
			$this->onAttack();
		}

		return $this->battleActionsService->getActions();
	}

	/**
	 * Return if the battle can continue
	 *
	 * @return bool
	 */
	public function canContinue(): bool
	{
		$playerTeamAlive = array_filter(
			$this->playerTeam,
			fn(BattlerCharacter $character) => !$character->isDead(),
		);
		$enemyTeamAlive = array_filter(
			$this->enemyTeam,
			fn(BattlerCharacter $character) => !$character->isDead(),
		);

		return !empty($playerTeamAlive) && !empty($enemyTeamAlive);
	}

	/**
	 * Setup teams, converting Character to BattlerCharacter
	 *
	 * @param Character[] $playerTeam
	 * @param Character[] $enemyTeam
	 */
	public function setupTeams(array $playerTeam, array $enemyTeam): void
	{
		$this->playerTeam = array_map(
			fn(Character $character) => new BattlerCharacter($character),
			$playerTeam,
		);
		$this->enemyTeam = array_map(
			fn(Character $character) => new BattlerCharacter($character),
			$enemyTeam,
		);
	}

	/**
	 * Generate random enemies
	 *
	 * @param int $amount
	 * @return Character[]
	 */
	public function generateEnemies(int $amount): array
	{
		$enemies = [];
		$charactersList = $this->charactersRepository->getCharactersList();

		for ($i = 0; $i < $amount; $i++) {
			$randomIndex = array_rand($charactersList);
			$enemies[] = $charactersList[$randomIndex];
		}

		return $enemies;
	}


	/**
	 * Attack Action
	 *
	 * When the first character of the player team attacks the first character of the enemy team.
	 *
	 * @throws Exception When the attackers aren't found
	 */
	private function onAttack(): void
	{
		$playerAttackerCharacter = find(
			$this->playerTeam,
			fn(BattlerCharacter $character) => !$character->isDead(),
		);
		$enemyAttackerCharacter = find(
			$this->enemyTeam,
			fn(BattlerCharacter $character) => !$character->isDead(),
		);

		if ($playerAttackerCharacter === null) {
			throw new Exception('Player Attacker not found');
		}

		if ($enemyAttackerCharacter === null) {
			throw new Exception('Enemy Attacker not found');
		}

		$playerDamageReceived = $playerAttackerCharacter->receiveAttackDamage($enemyAttackerCharacter->doAttack());
		$enemyDamageReceived = $enemyAttackerCharacter->receiveAttackDamage($playerAttackerCharacter->doAttack());

		$this->battleActionsService->registerAttackAction(
			$playerAttackerCharacter->getId(),
			$enemyAttackerCharacter->getId(),
			$playerDamageReceived,
			$enemyDamageReceived,
		);

	}
}