<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MesinscriptionsController extends AbstractController
{
    #[Route('/mesinscriptions', name: 'app_mesinscriptions')]
    public function index(): Response
    {
        $user = $this -> getUser();
        $tab = [];
        if($user instanceof User){
            $tab = $user -> getListelecons() ;
        }

        return $this->render('mesinscriptions/index.html.twig', [
            'lecons' => $tab,

        ]);
    }
}
