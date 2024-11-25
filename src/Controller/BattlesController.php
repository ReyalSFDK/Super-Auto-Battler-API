<?php

namespace App\Controller;

use App\Entity\Character;
use App\Model\CreateBattleDTO;
use App\Repository\CharactersRepository;
use App\Service\BattleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/battles', name: 'battles_', format: 'json')]
class BattlesController extends AbstractController
{
	public function __construct(
		private readonly CharactersRepository $charactersRepository,
		private readonly BattleService $battleService,
	) { }

	#[Route('/', name: 'new', methods: ['POST'])]
	public function new(
		#[MapRequestPayload] CreateBattleDTO $createBattleDTO,
	): Response
	{
		$characters = $createBattleDTO->characters;

		$charactersList = array_map(
			fn(string $identifier) => $this->charactersRepository->getCharacter($identifier),
			$characters,
		);

		$charactersList = array_filter(
			$charactersList,
			fn(?Character $character) => $character !== null,
		);

		if (count($charactersList) == 0) {
			return $this->json(['error' => 'Characters not found'], Response::HTTP_NOT_FOUND);
		}

		if (count($charactersList) > 5) {
			return $this->json(['error' => 'Maximum 5 characters allowed'], Response::HTTP_BAD_REQUEST);
		}

		$battleResult = $this->battleService->battle($charactersList);
		return $this->json($battleResult);
	}

}