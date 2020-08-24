<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\TimerRepository;
use App\Entity\Timer;

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
    * @Route("/projects/{id}/timers", name="timer")
    */
    // public function createTimer(Request $request, int $id)
    // {
    //     $content = json_decode($request->getContent(), true);
    //     $project = $this->projectRepository->find($id);
    //     $timer = new Timer();
    //     $timer->setidUser($this->getidUser());
    //     $timer->setidTeam($this->getidTeam());
    //     $timer->setidProject($project);
    //     $timer->setDatetime_Debut(new \DateTime());
    //     $timer->setDatetime_Fin(new \DateTime());
    //     $timer->setCumul_s($this->getCumul_s());
    //     $timer->setTimerComment($this->getTimerComment());
    //     $this->updateDatabase($timer);
    //     // Serialize object into Json format
    //     $jsonContent = $this->serializeObject($timer);
    //     return new Response($jsonContent, Response::HTTP_OK);
    // }
    
    /**
    * @Route("/project/timers/active", name="active_timer")
    */
    // public function runningTimer()
    // {
    //     $timer = $this->timerRepository->findRunningTimer($this->getidUser()->getId());
    //     $jsonContent = $this->serializeObject($timer);
    //     return new Response($jsonContent, Response::HTTP_OK);
    // }

    /**
    * @Route("/projects/{id}/timers/stop", name="stop_running")
    */
//    public function stopRunningTimer()
//    {
//        $timer = $this->timerRepository->findRunningTimer($this->getidUser()->getId());
//        if ($timer) {
//            $timer->setDateTime_fin(new \DateTime());
//            $this->updateDatabase($timer);
//        }
//        // Serialize object into Json format
//        $jsonContent = $this->serializeObject($timer);
//        return new Response($jsonContent, Response::HTTP_OK);
//    }
}