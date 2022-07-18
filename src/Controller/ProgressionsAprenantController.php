<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\EtudiantsRepository;
use App\Repository\NotesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgressionsAprenantController extends AbstractController
{
    /**
     * @Route("/progressions/aprenant", name="app_progressions_aprenant")
     */
    public function index(EtudiantsRepository $etudiantsRepository,NotesRepository $notesRepository): Response
    {
        $user= $this->getUser();
        $etudiant = $etudiantsRepository->findOneBy(array('user'=>$user));

        return $this->render('progressions_aprenant/index.html.twig', [
            'controller_name' => 'ProgressionsAprenantController',
            'etudiants' => $etudiantsRepository->findBy(array('user'=>$user)),
            'notes' => $notesRepository->findBy(array('etudiantid'=>$etudiant)),
        ]);
    }
}
