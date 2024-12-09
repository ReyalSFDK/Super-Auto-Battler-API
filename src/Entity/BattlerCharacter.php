<?php

namespace App\Entity;

class BattlerCharacter
{
	/**
	 * TEMPORARY
	 * BattlerCharacter identifier
	 */
	public string $id;

	/**
	 * BattlerCharacter base health points
	 */
	private int $baseHealth;

	/**
	 * BattlerCharacter current health points
	 */
	private int $currentHealth;

	/**
	 * BattlerCharacter base damage points
	 */
	private int $baseDamage;

	/**
	 * BattlerCharacter constructor.
	 * @param Character $character
	 */
	public function __construct(
		public Character $character,
	)
	{
		$this->id = uniqid();
		$this->baseHealth = $character->getHealth();
		$this->currentHealth = $this->baseHealth;
		$this->baseDamage = $character->getDamage();
	}

	/**
	 * Get BattlerCharacter identifier
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
	}

	/**
	 * Check if character is dead
	 * @return bool
	 */
	public function isDead(): bool {
		return $this->currentHealth <= 0;
	}

	/**
	 * Calculate damage on attack
	 * @return int Character total damage points
	 */
	public function doAttack(): int {
		return $this->baseDamage;
	}

	/**
	 * Receive damage on received attack
	 * @param int $damage Opponent damage points
	 * @return int Remaining health points
	 */
	public function receiveAttackDamage(int $damage): int {
		$remainingHealth = $this->currentHealth - $damage;

		if ($remainingHealth < 0) {
			$this->currentHealth = 0;
		} else {
			$this->currentHealth = $remainingHealth;
		}

		return $this->currentHealth;
	}

	public function toJson(): array
	{
		return [
			'id' => $this->id,
			'name' => $this->character->getIdentifier(),
			'health' => $this->currentHealth,
			'damage' => $this->baseDamage,
		];
	}
}