<?php

namespace App\Entity\Characters;

use App\Entity\Character;

class Mage extends Character {
	/**
	 * Mage constructor.
	 */
	public function __construct() {
		$identifier = 'MAGE';
		$health = 2;
		$damage = 3;

		parent::__construct($identifier, $health, $damage);
	}
}