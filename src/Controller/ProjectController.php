<?php

namespace App\Controller;

use App\Entity\{Project, Team, UserProject};
use App\Form\{ProjectType, ProjectToTeamType};
use App\Repository\{ProjectRepository,UserTeamRepository};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
/**
 * @Route("/project")
 */
class ProjectController extends AbstractController
{
    /**
     * @Route("/", name="project_index", methods={"GET"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function index(ProjectRepository $projectRepository): Response
    {
        return $this->render('project/index.html.twig', [
            'projects' => $projectRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="project_new", methods={"GET","POST"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function new(Request $request): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $createdDate = date('Y-m-d H:i:s');
            $project->setDateCreation(new \DateTime($createdDate));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('project_index');
        }

        return $this->render('project/new.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/addProject/{idTeam}", name="project_add_team", methods={"GET","POST"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function addProjetToTeam(Request $request, ProjectRepository $ProjectRepo, Team $idTeam, UserTeamRepository $UserTeamRepo ): Response
    {
        $form = $this->createForm(ProjectToTeamType::class);
        $form->handleRequest($request);

        $projectInTeam = $idTeam->getProjects();
        $userTeamList = $UserTeamRepo->findBy(array('idTeam'=>$idTeam->getId()));

        $msg = '';

        if ($form->isSubmitted() && $form->isValid()) {

            $FormProjet = $form->get('name_project')->getData();
            if($FormProjet){
                $idProjet = $FormProjet->getId();

                $project = $ProjectRepo->findOneBy(array('id'=>$idProjet));

                $admin = $idTeam->getTeamAdmin();

                if($project){
                    $project->setTeam($idTeam);
                    
                    $entityManager = $this->getDoctrine()->getManager();

                    $this->PrepareAjoutUserProject($entityManager,$admin,$FormProjet);//ajout projet à admin

                    foreach ($userTeamList as $userTeam) {
                        $user = $userTeam->getIdUser();
                        // $entityManager->persist($userProject);
                        $this->PrepareAjoutUserProject($entityManager,$user,$FormProjet);//ajout projet aux membres d'équipe
                    }

                    $entityManager->persist($project);
                    $entityManager->flush();

                }

            }else{
                $msg = 'Plus de projet à ajouter';
            }

            // return $this->redirectToRoute('project_index');
        }

        return $this->render('project/newProjectToTeam.html.twig', [
            'form' => $form->createView(),
            'idTeam' => $idTeam,
            'projectInTeam' => $projectInTeam,
            'msg' => $msg
        ]);
    }

    public function PrepareAjoutUserProject($entityManager,$user,$projet ){
        $createdDate = date('Y-m-d H:i:s');
        $obj = new UserProject();
        $obj->setIdUser($user);
        $obj->setIdProject($projet);
        $obj->setDateCreation(new \DateTime($createdDate));

        $entityManager->persist($obj);
    }

    /**
     * @Route("/{id}", name="project_show", methods={"GET"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function show(Project $project): Response
    {
        return $this->render('project/show.html.twig', [
            'project' => $project,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="project_edit", methods={"GET","POST"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function edit(Request $request, Project $project): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('project_index');
        }

        return $this->render('project/edit.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="project_delete", methods={"DELETE"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function delete(Request $request, Project $project): Response
    {
        if ($this->isCsrfTokenValid('delete'.$project->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($project);
            $entityManager->flush();
        }

        return $this->redirectToRoute('project_index');
    }


}

