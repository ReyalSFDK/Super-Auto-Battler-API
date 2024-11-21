<?php

namespace App\Entity\Characters;

use App\Entity\Character;

class Archer extends Character {
	/**
	 * Archer constructor.
	 */
	public function __construct() {
		$identifier = 'ARCHER';
		$health = 1;
		$damage = 1;

		parent::__construct($identifier, $health, $damage);
	}
}