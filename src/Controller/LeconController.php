<?php

namespace App\Controller;

use App\Entity\Lecon;
use App\Entity\User;
use App\Form\LeconType;
use App\Repository\LeconRepository;
use cebe\markdown\Markdown;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/lecon')]
class LeconController extends AbstractController
{
    #[IsGranted('ROLE_PROF')]
    #[Route('/', name: 'app_lecon_index', methods: ['GET'])]
    public function index(LeconRepository $leconRepository, Markdown $markdown): Response
    {
        $lecons=$leconRepository->findAll();
        $parsedLecons=[];
        foreach ($lecons as $lecon){
            $parseLecon = $lecon;
            $parseLecon->setDescription($markdown->parse($lecon->getDescription()));
            $parsedLecons[]=$parseLecon;
        }
        return $this->render('lecon/index.html.twig', [
            'lecons' => $parsedLecons
        ]);
    }

    #[IsGranted('ROLE_PROF')]
    #[Route('/new', name: 'app_lecon_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $lecon = new Lecon();
        $form = $this->createForm(LeconType::class, $lecon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($lecon);
            $entityManager->flush();

            return $this->redirectToRoute('app_lecon_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('lecon/new.html.twig', [
            'lecon' => $lecon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lecon_show', methods: ['GET'])]
    public function show(Lecon $lecon): Response
    {
        return $this->render('lecon/show.html.twig', [
            'lecon' => $lecon,
            'estinscrit'=> $lecon->getInscriptions()->contains($this->getUser())
        ]);
    }

    #[IsGranted('ROLE_PROF')]
    #[Route('/{id}/edit', name: 'app_lecon_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lecon $lecon, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LeconType::class, $lecon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_lecon_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('lecon/edit.html.twig', [
            'lecon' => $lecon,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_PROF')]
    #[Route('/{id}', name: 'app_lecon_delete', methods: ['POST'])]
    public function delete(Request $request, Lecon $lecon, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lecon->getId(), $request->request->get('_token'))) {
            $entityManager->remove($lecon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_lecon_index', [], Response::HTTP_SEE_OTHER);
    }

    #[IsGranted('ROLE_PROF')]
    #[Route('/inscrire/{id}', name: 'app_lecon_inscrire')]
    public function inscrire(Lecon $lecon, EntityManagerInterface $entityManager):Response
    {
        $user =$this ->getUser();
        if($user instanceof User){
            $lecon -> addInscription($user);
            $user -> addListelecon($lecon);
            $entityManager->persist($user);
            $entityManager->persist($lecon);
            $entityManager->flush();

        }

        return $this -> render('lecon/show.html.twig',[
            "lecon" =>$lecon,
            "estinscrit" => true
        ]);
    }

    #[IsGranted('ROLE_PROF')]
    #[Route('/desinscrire/{id}', name: 'app_lecon_desinscrire')]
    public function desinscrire(Lecon $lecon, EntityManagerInterface $entityManager):Response
    {
        $user =$this ->getUser();
        if($user instanceof User){
            $lecon -> removeInscription($user);
            $user -> removeListelecon($lecon);
            $entityManager->persist($user);
            $entityManager->persist($lecon);
            $entityManager->flush();
        }

        return $this -> render('lecon/show.html.twig',[
            "lecon" =>$lecon,
            "estinscrit" => false
        ]);
    }
    #[Route('/liste/{id}', name: 'app_lecon_liste', methods: ['GET'])]
    public function voirlisteinscrit(Lecon $lecon) :Response
    {
        return $this ->render('lecon/listeparticipants.html.twig', [
            'participants' => $lecon ->getInscriptions()
        ]);

    }
}
