<?php

namespace App\Entity\Characters;

use App\Entity\Character;

class Warrior extends Character {
	/**
	 * Warrior constructor.
	 */
	public function __construct() {
		$identifier = 'WARRIOR';
		$health = 5;
		$damage = 2;

		parent::__construct($identifier, $health, $damage);
	}
}