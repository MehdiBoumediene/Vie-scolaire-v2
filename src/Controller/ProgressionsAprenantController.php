<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\EtudiantsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgressionsAprenantController extends AbstractController
{
    /**
     * @Route("/progressions/aprenant", name="app_progressions_aprenant")
     */
    public function index(EtudiantsRepository $etudiantsRepository): Response
    {
        $user= $this->getUser();

        return $this->render('progressions_aprenant/index.html.twig', [
            'controller_name' => 'ProgressionsAprenantController',
            'etudiants' => $etudiantsRepository->findByUser($user),
        ]);
    }
}
