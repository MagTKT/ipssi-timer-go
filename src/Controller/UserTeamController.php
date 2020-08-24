<?php

namespace App\Controller;

use App\Entity\{Team, UserTeam};
use App\Form\UserTeamType;
use App\Repository\UserTeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/team")
 */
class UserTeamController extends AbstractController
{
    /**
     * @Route("/", name="user_team_index", methods={"GET"})
     */
    public function index(UserTeamRepository $userTeamRepository): Response
    {
        return $this->render('user_team/index.html.twig', [
            'user_teams' => $userTeamRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{idTeam}", name="user_team_new", methods={"GET","POST"})
     */
    public function new(Request $request, Team $idTeam): Response
    {
        $userTeam = new UserTeam();
        $form = $this->createForm(UserTeamType::class, $userTeam);
        $form->handleRequest($request);
        //var_dump($request);
        //die();
        if ($form->isSubmitted() && $form->isValid()) {
            $createdDate = date('Y-m-d H:i:s');
            $userTeam->setDateCreation(new \DateTime($createdDate));

            $userTeam->setIdTeam($idTeam);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userTeam);
            $entityManager->flush();

            return $this->redirectToRoute('team_index');
        }

        return $this->render('user_team/new.html.twig', [
            'user_team' => $userTeam,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_team_show", methods={"GET"})
     */
    public function show(UserTeam $userTeam): Response
    {
        return $this->render('user_team/show.html.twig', [
            'user_team' => $userTeam,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_team_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserTeam $userTeam): Response
    {
        $form = $this->createForm(UserTeamType::class, $userTeam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_team_index');
        }

        return $this->render('user_team/edit.html.twig', [
            'user_team' => $userTeam,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_team_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UserTeam $userTeam): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userTeam->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userTeam);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_team_index');
    }
}
