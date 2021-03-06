<?php

namespace App\Controller;

use App\Entity\Calendrier;
use App\Form\CalendrierType;
use App\Repository\CalendrierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/calendrier")
 */
class CalendrierController extends AbstractController
{
    /**
     * @Route("/", name="app_calendrier_index", methods={"GET"})
     */
    public function index(CalendrierRepository $calendrierRepository): Response
    {
        return $this->render('calendrier/index.html.twig', [
            'calendriers' => $calendrierRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_calendrier_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CalendrierRepository $calendrierRepository,EntityManagerInterface $em): Response
    {
        $calendrier = new Calendrier();
        $form = $this->createForm(CalendrierType::class, $calendrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $calendrierRepository->add($calendrier);

            $type = $calendrier->getTitre();
            $classe = $calendrier->getClasse();
            $module = $calendrier->getModule();
            $date = $calendrier->getDate()->format('Y-m-d') ;
            $heure = $calendrier->getHeurdebut()->format('H:i') ;


            $message= "Nouvel événement: $type $module le $date à $heure";
         


            $sql = "INSERT INTO `notifications` (`id`, `type`, `classeid`, `message` ) VALUES (NULL, '$type', '$classe', '$message')";
            $stmt = $em->getConnection()->prepare($sql);
         
            $result = $stmt->execute();



            return $this->redirectToRoute('app_gestion_calendrier', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('calendrier/new.html.twig', [
            'calendrier' => $calendrier,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_calendrier_show", methods={"GET"})
     */
    public function show(Calendrier $calendrier): Response
    {
        return $this->render('calendrier/show.html.twig', [
            'calendrier' => $calendrier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_calendrier_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Calendrier $calendrier, CalendrierRepository $calendrierRepository): Response
    {
        $form = $this->createForm(CalendrierType::class, $calendrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $calendrierRepository->add($calendrier);
            return $this->redirectToRoute('app_calendrier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('calendrier/edit.html.twig', [
            'calendrier' => $calendrier,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_calendrier_delete", methods={"POST"})
     */
    public function delete(Request $request, Calendrier $calendrier, CalendrierRepository $calendrierRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$calendrier->getId(), $request->request->get('_token'))) {
            $calendrierRepository->remove($calendrier);
        }

        return $this->redirectToRoute('app_calendrier_index', [], Response::HTTP_SEE_OTHER);
    }
}
