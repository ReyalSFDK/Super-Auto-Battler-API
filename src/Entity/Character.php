<?php

namespace App\Entity;

class Character {
	/**
	 * @var int Character total health points
	 */
	public int $health;

	/**
	 * @var int Character total damage points
	 */
	public int $damage;

	/**
	 * @var string Character identifier
	 */
	public string $identifier;

	/**
	 * Character constructor.
	 * @param string $identifier
	 * @param int $health
	 * @param int $damage
	 */
	public function __construct(string $identifier, int $health, int $damage) {
		$this->setIdentifier($identifier);
		$this->setHealth($health);
		$this->setDamage($damage);
	}

	/**
	 * @return string
	 */
	public function getIdentifier(): string {
		return $this->identifier;
	}

	/**
	 * @param string $identifier
	 * @return Character
	 */
	public function setIdentifier(string $identifier): Character {
		$this->identifier = $identifier;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getHealth(): int {
		return $this->health;
	}

	/**
	 * @param int $health
	 * @return Character
	 */
	public function setHealth(int $health): Character {
		$this->health = $health;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getDamage(): int {
		return $this->damage;
	}

	/**
	 * @param int $damage
	 * @return Character
	 */
	public function setDamage(int $damage): Character {
		$this->damage = $damage;
		return $this;
	}

	/**
	 * Convert object to JSON
	 * @return array
	 */
	public function toJson(): array {
		return [
			'identifier' => $this->getIdentifier(),
			'health' => $this->getHealth(),
			'damage' => $this->getDamage()
		];
	}
}