<?php

namespace App\Repository;

use App\Entity\Character;
use App\Entity\Characters\Mage;
use App\Entity\Characters\Warrior;

class CharactersRepository {
	/**
	 * @var Character[]
	 */
	public $charactersList = [];

	public function __construct() {
		$this->charactersList = [
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
}