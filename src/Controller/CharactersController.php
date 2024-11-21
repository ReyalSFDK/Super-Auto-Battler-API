<?php

namespace App\Controller;

use App\Entity\Character;
use App\Repository\CharactersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CharactersController extends AbstractController
{
	public function __construct(
		private readonly CharactersRepository $charactersRepository,
	) { }

	#[Route('/characters')]
	public function list(): Response
	{
		$charactersList = $this->charactersRepository->getCharactersList();

		$response = array_map(
			fn(Character $character) => $character->toJson(),
			$charactersList,
		);

		return $this->json($response);
	}
}
