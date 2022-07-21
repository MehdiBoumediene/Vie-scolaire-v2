<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\EtudiantsRepository;
use App\Repository\NotesRepository;
use App\Entity\Etudiants;
use App\Repository\AbsencesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgressionsAprenantController extends AbstractController
{
    /**
     * @Route("/progressions/aprenant", name="app_progressions_aprenant")
     */
    public function index( EtudiantsRepository $etudiantsRepository,  AbsencesRepository $absencesRepository, NotesRepository $notesRepository): Response
    {

        $delay = new \Datetime('last month');
        $day = new \Datetime('last day');

        $user = $this->getUser();
        $classe = $user->getClasse();
        $etudiant = $etudiantsRepository->findBy(array('user'=>$user));

        return $this->render('progressions_aprenant/index.html.twig', [
            'controller_name' => 'ProgressionsAprenantController',
            'etudiants' => $etudiantsRepository->findBy(array('user'=>$user)),
            'notes' => $notesRepository->findBy(array('etudiantid'=>$etudiant)),
            'modules' => $absencesRepository->findBy(array('classe'=>$classe)),
            'retards' => $absencesRepository->findByUserAbsences($etudiant,$delay,$day),
            'absences' => $absencesRepository->findByUser($etudiant,$delay,$day),
            'notes' => $notesRepository->findBy(array('etudiantid'=>$etudiant)),
        ]);
    }
}
