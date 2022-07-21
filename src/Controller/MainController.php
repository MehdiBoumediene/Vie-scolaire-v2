<?php

namespace App\Controller;

use App\Repository\CalendrierRepository;
use App\Repository\UsersRepository;
use App\Repository\AbsencesRepository;
use App\Repository\ApprenantsRepository;
use App\Repository\ClassesRepository;
use App\Entity\Absences;
use App\Entity\Users;
use App\Form\AbsencesType;
use App\Repository\EtudiantsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\NotificationsRepository;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_main")
     */
    public function index(NotificationsRepository $notificationsRepository, ClassesRepository $classesRepository, ): Response
    {
    
    
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            
        ]);
    }


    /**
     * @Route("/gestion/calendrier", name="app_gestion_calendrier")
     */
    public function calendrier(CalendrierRepository $calendrier,EtudiantsRepository $apprenants,Request $request, AbsencesRepository $absencesRepository): Response
    {
        $events = $calendrier->findAll();
        $rdvs = [];
        $rdvs2 = [];
        foreach ($events as $event){
            
            $rdvs[] = [
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:i'),
                'end' => $event->getEnd()->format('Y-m-d H:i'),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBackgroundColor(),
                'textColor' => $event->getTextColor(),
                'title' => $event->getTitre(),
                'description' => $event->getDescription(),
                'classe' => $event->getClasse()->getNom(),
             
                'module' => $event->getModule()->getNom(),
                'moduleid'=> $event->getModule()->getId(),
                'intervenant' => $event->getIntervenant()->getNom(),
                'textColor' => $event->getTextColor(),
                'allDay' => $event->getAllDay(),
                'type' => $event->getType(),


            ];


            
            $classe= $event->getClasse()->getId();


            $data = json_encode($rdvs);
     
            
        }

        $etudiants = $apprenants->findByClasse($classe);

         
        return $this->render('main/gestion_calendrier.html.twig', [
            'etudiants_calendar' => $etudiants,
            'data' => compact('data'),
          
        ]
    
    );
    }


    
     /**
     * @Route("/calendrier_absences", name="app_gestion_calendrier_absences", methods={"GET", "POST"})
     */
    public function calendrierAbsences( EntityManagerInterface $em, EtudiantsRepository $etudiantsRepository, Request $request): Response
    {
        $date = date('Y-m-d H:i:s');
        $etat = $request->query->get('etat');
        $user = $request->query->get('user');
        $duree = $request->query->get('duree');
        $module = $request->query->get('module');
  
        $etudiant = $etudiantsRepository->findOneBy(array('user'=>$user));
        $username = $etudiant->getNom();
     

  if( $etat == 'Présent'){
    $sql = "INSERT INTO `absences` (`id`, `module_id`, `date`, `created_at`, `created_by`, `du`, `au`, `classe_id`, `absent`, `dateabsence`, `enretard`, `dateretard`, `present`, `datepresence`, `user_id`, `userid`, `username`, `retard`) VALUES (NULL, '$module', '$date', '2022-04-04 10:37:26', NULL, '2022-06-07 16:40:41', '2022-06-07 16:40:41', '2', '0', '2022-06-07 16:48:04', '0', '2022-06-07 16:48:04', '1', '2022-06-07 16:48:04', '$user', '$user', '$username',null)";
    $stmt = $em->getConnection()->prepare($sql);
 
    $result = $stmt->execute();
  
  }  elseif( $etat == 'En retard'){
    $sql = "INSERT INTO `absences` (`id`, `module_id`, `date`, `created_at`, `created_by`, `du`, `au`, `classe_id`, `absent`, `dateabsence`, `enretard`, `dateretard`, `present`, `datepresence`, `user_id`, `userid`, `username`, `retard`) VALUES (NULL, '$module', '$date', '2022-04-04 10:37:26', NULL, '2022-06-07 16:40:41', '2022-06-07 16:40:41', '2', '0', '2022-06-07 16:48:04', '1', '2022-06-07 16:48:04', '0', '2022-06-07 16:48:04', '$user', '$user', '$username',null)";
    $stmt = $em->getConnection()->prepare($sql);
 
    $result = $stmt->execute();
  } elseif( $etat == 'absent'){
    $sql = "INSERT INTO `absences` (`id`, `module_id`, `date`, `created_at`, `created_by`, `du`, `au`, `classe_id`, `absent`, `dateabsence`, `enretard`, `dateretard`, `present`, `datepresence`, `user_id`, `userid`, `username`, `dureeretard`) VALUES (NULL, '$module', '$date', '2022-04-04 10:37:26', NULL, '2022-06-07 16:40:41', '2022-06-07 16:40:41', '2', '1', '2022-06-07 16:48:04', '0', '2022-06-07 16:48:04', '0', '2022-06-07 16:48:04', '$user', '$user', '$username',null)";
    $stmt = $em->getConnection()->prepare($sql);
 
    $result = $stmt->execute();
  }
  elseif( $etat == 'duree'){
    
    $sql = "INSERT INTO `absences` (`id`, `module_id`, `date`, `created_at`, `created_by`, `du`, `au`, `classe_id`, `absent`, `dateabsence`, `enretard`, `dateretard`, `present`, `datepresence`, `user_id`, `userid`, `username`, `dureeretard`) VALUES (NULL, '$module', '$date', null, NULL, null, null, '2', '0', null, '1', null, '0', null, '$user', '$user', '$username','$duree')";
    $stmt = $em->getConnection()->prepare($sql);
 
    $result = $stmt->execute();
  }
 
        // returns an array of Product objects  
        $response = new JsonResponse();
        $response->setContent(json_encode($etat));
        $response->headers->set('Content-Type','application/json');

        return $response->setData(array('etat'=>$etat,'user'=>$user));

    
  
    }

    /**
     * @Route("/calendrier_etudiant", name="app_calendrier_etudiant")
     */
    public function calendrierEtudiant(CalendrierRepository $calendrier,UsersRepository $users, EtudiantsRepository $apprenants ): Response
    {
        $events = $calendrier->findAll();
        $rdvs = [];
        foreach ($events as $event){

            $rdvs[] = [
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:i'),
                'end' => $event->getEnd()->format('Y-m-d H:i'),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBackgroundColor(),
                'textColor' => $event->getTextColor(),
                'title' => $event->getTitre(),
                'description' => $event->getDescription(),
                'classe' => $event->getClasse()->getNom(),
                'module' => $event->getModule()->getNom(),
                'moduleid'=> $event->getModule()->getId(),
                'intervenant' => $event->getIntervenant()->getNom(),
                'textColor' => $event->getTextColor(),
                'allDay' => $event->getAllDay(),
                'type' => $event->getType(),


            ];

            $data = json_encode($rdvs);
            $classe= $event->getClasse()->getId();
        }
        $etudiants = $apprenants->findByClasse($classe);
        return $this->render('main/gestion_calendrier.html.twig', [
            'etudiants_calendar' => $etudiants,
            'data' => compact('data'),
          
        ]
    
    );
 
    }

     /**
     * @Route("/calendrier_intervenant", name="app_calendrier_intervenant")
     */
    public function calendrierIntervenant(CalendrierRepository $calendrier): Response
    {
        $events = $calendrier->findAll();
        $rdvs = [];
        foreach ($events as $event){

            $rdvs[] = [
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:i'),
                'end' => $event->getEnd()->format('Y-m-d H:i'),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBackgroundColor(),
                'textColor' => $event->getTextColor(),
                'title' => $event->getTitre(),
                'description' => $event->getDescription(),
                'textColor' => $event->getTextColor(),
                'allDay' => $event->getAllDay(),
                'type' => $event->getType(),
                'moduleid'=> $event->getModule()->getId(),


            ];

            $data = json_encode($rdvs);
        }
        return $this->render('main/calendrier_intervenant.html.twig',compact('data'));
    }
}
