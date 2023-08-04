<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PublicationRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function __construct(
        private PublicationRepository $publicationRepository,
        private EntityManagerInterface $entityManager,
        private PaginatorInterface $paginator,
    ) {
    }


    #[Route('/', name: 'app_home', methods:['GET'])]
    public function index(PublicationRepository $publicationRepository): Response
    {

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'publications' => $publicationRepository->findAll()
        ]);
    }

    
}