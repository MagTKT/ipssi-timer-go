<?php

namespace App\Controller;

use App\Entity\Timer;
use App\Form\TimerType;
use App\Repository\TimerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
            'timers' => $timerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="timer_new", methods={"GET","POST"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function new(Request $request): Response
    {
        $timer = new Timer();
        $form = $this->createForm(TimerType::class, $timer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($timer);
            $entityManager->flush();

            return $this->redirectToRoute('timer_index');
        }

        return $this->render('timer/new.html.twig', [
            'timer' => $timer,
            'form' => $form->createView(),
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
}
