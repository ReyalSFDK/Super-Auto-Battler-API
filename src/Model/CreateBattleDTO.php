<?php

namespace App\Model;

final class CreateBattleDTO
{
	/**
	 * @param string[] $characters
	 */
	public function __construct(
		public readonly array $characters = [],
	) { }
}