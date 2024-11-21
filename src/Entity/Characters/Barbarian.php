<?php

namespace App\Entity\Characters;

use App\Entity\Character;

class Barbarian extends Character {
	/**
	 * Barbarian constructor.
	 */
	public function __construct() {
		$identifier = 'BARBARIAN';
		$health = 4;
		$damage = 4;

		parent::__construct($identifier, $health, $damage);
	}
}