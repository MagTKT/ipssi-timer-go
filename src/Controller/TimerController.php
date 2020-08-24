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
     * @Route("/new", name="timer_new", methods={"GET"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function new(TimerRepository $timerRepository): Response
    {
        return $this->render('timer/new.html.twig', [
            'timer' => $timerRepository->findAll(),
        ]);
    }
}