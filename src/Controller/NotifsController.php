<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\NotificationsRepository;

class NotifsController extends AbstractController
{
    #[Route('/notifs', name: 'app_notifs')]
    public function index(NotificationsRepository $notificationsRepository): Response
    {
        $user = $this->getUser();
        
        $classe = $user->getClasse();


        return $this->render('notifs/index.html.twig', [
          
            'notifications' => $notificationsRepository->findBy(array('classeid'=>$classe)),
        ]);
    }
}
