<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\CategorieRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_produit')]
    public function index(ProductRepository $repos): Response
    {
        $produits = $repos->findAll();
        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
        ]);
    }
    #[Route('/produit/detail/{id}', name: 'app_produit_detail')]
    public function detail(ProductRepository $repos,$id): Response
    {
        $produit = $repos->find($id);
        return $this->render('produit/detail.html.twig', ['produit'=>$produit
            
        ]);
    }
    #[Route('/produit/add/{name}/{price}/{stock}/{idc}', name: 'app_produit_add')]
    public function add(CategorieRepository $repos,EntityManagerInterface $em,$name,$price,$stock,$idc): Response
    {
        $category = $repos->find($idc);
        $produit = new Product(); 
        $dc = new \DateTime();
        $produit->setName($name)
                ->setPrice($price)
                ->setStock($stock)
                ->setCteatedAt($dc)
                ->setCategory($category);  
        $em->persist($produit);
        $em->flush();
        return $this->render('produit/detail.html.twig', [
            'produit' => $produit,
        ]);
    }
    #[Route('/produit/delete/{id}', name: 'app_produit_delete')]
    public function delete(ProductRepository $repo, EntityManagerInterface $em,$id): Response
    {
        
        $produit = $repo->find($id);
        $em->remove($produit);
        $em->flush();
        return $this->redirectToRoute('app_produit');
    }
    #[Route('/produit/update/{id}', name: 'app_produit_update')]
    public function update(ProductRepository $repo, EntityManagerInterface $em,$id): Response
    {
        
        $produit = $repo->find($id);
        $produit->setPrice($produit->getPrice() + 10);
        $em->persist($produit);
        $em->flush();
        return $this->redirectToRoute('app_produit');
    }
}
