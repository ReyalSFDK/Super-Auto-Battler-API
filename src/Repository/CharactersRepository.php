<?php

namespace App\Repository;

use App\Entity\Character;
use App\Entity\Characters\Archer;
use App\Entity\Characters\Barbarian;
use App\Entity\Characters\Mage;
use App\Entity\Characters\Warrior;

class CharactersRepository {
	/**
	 * @var Character[]
	 */
	public array $charactersList = [];

	public function __construct() {
		$this->charactersList = [
			new Archer(),
			new Barbarian(),
			new Mage(),
			new Warrior(),
		];
	}

	/**
	 * @return Character[]
	 */
	public function getCharactersList(): array {
		return $this->charactersList;
	}

	/**
	 * @param string $identifier
	 * @return Character|null
	 */
	public function getCharacter(string $identifier): ?Character {
		foreach ($this->charactersList as $character) {
			if ($character->getIdentifier() === $identifier) {
				return $character;
			}
		}

		return null;
	}
}