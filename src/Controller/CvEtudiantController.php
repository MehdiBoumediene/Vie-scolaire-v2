<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CvEtudiantController extends AbstractController
{
    #[Route('/cv/etudiant', name: 'app_cv_etudiant')]
    public function index(): Response
    {
        return $this->render('cv_etudiant/index.html.twig', [
            'controller_name' => 'CvEtudiantController',
        ]);
    }
}
