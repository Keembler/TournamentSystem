<?php

namespace App\Controller;

use App\Repository\TournamentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(TournamentRepository $tournamentRepository): Response
    {
        return $this->render('page/index.html.twig', [
            'tournaments' => $tournamentRepository->findAll(),
        ]);
    }
}
