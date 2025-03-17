<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        $monnom = "Lofti";
        return $this->render('main/index.html.twig', ['nom' =>$monnom  ]);
    }
    #[Route('/main2', name: 'app_main2')]
    public function index2(): Response
    {
        return $this->render('main/index2.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    #[Route('/page1/{prenom}', name: 'app_page1')]
    public function page1($prenom): Response
    {
        $nom = "Khediri";
       // $prenom = "Lotfi";
        $dateNaiss = "24/02/2025";
        $loisirs = ['lo1','lo2','lo3'];
        return $this->render('main/page1.html.twig', ['nom'=>$nom,
        'prenom'=>$prenom,'dateNaiss'=> $dateNaiss,'hobs' => $loisirs
            
        ]);
    }
    
}
