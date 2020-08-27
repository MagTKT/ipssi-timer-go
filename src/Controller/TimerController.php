<?php

namespace App\Controller;

use App\Entity\Timer;
use App\Form\TimerType;
use App\Repository\TimerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/timer")
 */
class TimerController extends AbstractController
{
    /**
     * @Route("/", name="timer_index", methods={"GET"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function index(TimerRepository $timerRepository): Response
    {
        return $this->render('timer/index.html.twig', [
            'timer' => $timerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="timer_new", methods={"GET","POST"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function new(Request $request, TimerRepository $TimerRepo): Response
    {
        $timer = new Timer();
        $form = $this->createForm(TimerType::class, $timer);
        $form->handleRequest($request);

        $msg = '';

        if ($form->isSubmitted() && $form->isValid()) {
            $timer = $TimerRepo->findOneBy(array('DateTime_Fin'=> null));
            if(!$timer){
                $project = $form->get('idProject')->getData();
                $team = $project->getTeam();
                $timer->setIdTeam($team);
     
                $dateDebut = date('Y-m-d H:i:s');
                $timer->setDateTimeDebut(new \DateTime($dateDebut));
                $id_user = $this->getUser();
                $timer->setIdUser($id_user);
            
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($timer);
                $entityManager->flush();
    
                return $this->redirectToRoute('timer_index');
            }else {
                $msg = 'Merci de stopper le timer en cours avant d\'en créer un nouveau';
            }
        }

        return $this->render('timer/new.html.twig', [
            'timer' => $timer,
            'form' => $form->createView(),
            'msg' => $msg
        ]);
    }


    /**
     * @Route("/stop", name="timer_stop", methods={"GET","POST"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function stop(Request $request, TimerRepository $TimerRepo): Response
    {
        $timer = $TimerRepo->findOneBy(array('DateTime_Fin'=> null));
        
        $msg = '';

        if ($timer) {
            $dateFin = new \DateTime(date('Y-m-d H:i:s'));
            $timer->setDateTimeFin($dateFin);
            
            // $dateDebut = $timer->getDateTimeDebut();
            // $timerDiff = $dateDebut->diff($dateFin);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($timer);
            $entityManager->flush();
        }else {
            $msg = 'Vous n`\'avez pas de timer à arrêter';
        }

        return $this->render('timer/index.html.twig', [
            'timer' => $TimerRepo->findAll(),
            'msg' => $msg
        ]);
    }


    /**
     * @Route("/{id}", name="timer_show", methods={"GET"})
     */
    public function show(Timer $timer): Response
    {
        return $this->render('timer/show.html.twig', [
            'timer' => $timer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="timer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Timer $timer): Response
    {
        $form = $this->createForm(TimerType::class, $timer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('timer_index');
        }

        return $this->render('timer/edit.html.twig', [
            'timer' => $timer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="timer_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Timer $timer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$timer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($timer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('timer_index');
    }


    public function cumulTimer($list)
    {
        //list=> liste des projets
        $date = new \DateTime();
        $dateTimeFormat = 'd H:i:s';
        $interval = 0;
        $j = 0;
        $h = 0;
        $m = 0;
        $s = 0;
        foreach ($list as $oneElement){
            if (($project->getDateTimeDebut() != null) && ($project->getDateTimeFin() != null)){
                $dateStartTimestamp = $project->getDateTimeDebut()->getTimestamp();
                $dateEndTimestamp = $project->getDateTimeFin()->getTimestamp();
                $interval += $dateEndTimestamp - $dateStartTimestamp;
            }
        }

        if($interval >= 86400){//24h
            $j = intval($interval / 86400);
            $interval = ($interval-(86400*$j));
            //on soustrait le cumul de des jours au total de l'interval pour calculer les restes (heures,minutes,secondes) plus tard
        }

        if($interval >= 3600){// 1h
            $h = intval($interval / 3600);
            $interval = ($interval-(3600*$h));
        }

        if($interval >= 60){// 1 min
            $m= intval($interval / 60);
            $interval = ($interval-(60*$m));
         }
        $s = $interval;//jours,heures et minutes soustrait du cumul d'interval, reste les secondes

        $cumulTimer = ['jours'=>$j,'heures'=>$h,'minutes'=>$m,'secondes'=>$s];

        return $cumulTimer;
    }
}
