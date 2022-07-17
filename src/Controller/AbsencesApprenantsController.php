<?php

namespace App\Controller;
use App\Entity\Absences;
use App\Form\AbsencesType;
use App\Repository\AbsencesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AbsencesApprenantsController extends AbstractController
{
    /**
     * @Route("/absences/apprenants", name="app_absences_apprenants")
     */
    public function index(AbsencesRepository $absencesRepository): Response
    {
        $user = 1;
        $delay = new \Datetime('last month');
        $day = new \Datetime('last day');

        return $this->render('absences_apprenants/index.html.twig', [
            'controller_name' => 'AbsencesApprenantsController',
            'retards' => $absencesRepository->findByUserAbsences($user,$delay,$day),
            'absences' => $absencesRepository->findByUser($user,$delay,$day),

        ]);
    }
}
