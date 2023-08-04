<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\AddCommentType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PublicationRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PublicationController extends AbstractController
{
    public function __construct(
        private PublicationRepository $publicationRepository,
        private CommentRepository $commentRepository,
        private EntityManagerInterface $entityManager,
        private PaginatorInterface $paginator,
    ) {
    }


    #[Route('/publication', name: 'app_publication')]
    public function index(): Response
    {
        return $this->render('publication/show.html.twig', [
            'controller_name' => 'PublicationController',
        ]);
    }

    #[Route('/show/{id}', name: 'app_publication_show')]
    public function detail($id, Request $request): Response
    {
        $publicationEntity = $this->publicationRepository->find($id);

        if ($publicationEntity === null) {
            return $this->redirectToRoute('app_publication');
        }

        $comment = new Comment();
        $comment->setCreatedAt(new \DateTime());
        $comment->setPublication($publicationEntity);

        $form = $this->createForm(AddCommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($comment);
            $this->entityManager->flush();
            return $this->redirectToRoute('app_publication');
        }

        return $this->render('publication/show.html.twig', [
            'publication' => $publicationEntity,
            'form' => $form->createView()
        ]);
        
    }
}
