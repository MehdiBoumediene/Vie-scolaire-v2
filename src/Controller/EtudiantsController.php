<?php

namespace App\Controller;

use App\Entity\Etudiants;
use App\Entity\Tuteurs;
use App\Form\EtudiantsType;
use App\Repository\EtudiantsRepository;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/etudiants")
 */
class EtudiantsController extends AbstractController
{
    /**
     * @Route("/", name="app_etudiants_index", methods={"GET"})
     */
    public function index(EtudiantsRepository $etudiantsRepository): Response
    {
        
          
            return $this->render('etudiants/index.html.twig', [
            'etudiants' => $etudiantsRepository->findAll(),
         
        ]);
    }

    /**
     * @Route("/new", name="app_etudiants_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EtudiantsRepository $etudiantsRepository): Response
    {
        $etudiant = new Etudiants();
        $form = $this->createForm(EtudiantsType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $date = new \DateTimeImmutable('now');
         
            $etudiant->setCreatedBy($this->getUser()->getEmail());
            $etudiant->setUser($this->getUser());
            
            $etudiant->setCreatedAt($date);
            $etudiantsRepository->add($etudiant);
            return $this->redirectToRoute('app_etudiants_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etudiants/new.html.twig', [
            'etudiant' => $etudiant,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_etudiants_show", methods={"GET"})
     */
    public function show(Etudiants $etudiant): Response
    {
        return $this->render('etudiants/show.html.twig', [
            'etudiant' => $etudiant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_etudiants_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Etudiants $etudiant, EtudiantsRepository $etudiantsRepository): Response
    {
        $form = $this->createForm(EtudiantsType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $etudiantsRepository->add($etudiant);
            return $this->redirectToRoute('app_etudiants_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etudiants/edit.html.twig', [
            'etudiant' => $etudiant,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_etudiants_delete", methods={"POST"})
     */
    public function delete(Request $request, Etudiants $etudiant, EtudiantsRepository $etudiantsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etudiant->getId(), $request->request->get('_token'))) {
            $etudiantsRepository->remove($etudiant);
        }

        return $this->redirectToRoute('app_etudiants_index', [], Response::HTTP_SEE_OTHER);
    }
}
