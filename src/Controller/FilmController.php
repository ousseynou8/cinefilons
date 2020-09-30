<?php

namespace App\Controller;


use App\Entity\Commentaire;
use App\Entity\Film;
use App\Form\CommentaireType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\FilmRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    /**
     * @Route("/film/{id<\d+>}/", name="film")
     */

    public function index(Film $film, Request $request, EntityManagerInterface $manager)
    {
        $commentaire = new Commentaire();
        $commentaireForm = $this->createForm(CommentaireType::class, $commentaire);

        $commentaireForm->handleRequest($request);

        if($commentaireForm->isSubmitted() && $commentaireForm->isValid() && $this->getUser()) {
            $commentaire->setFilm($film);
            $commentaire->setUser($this->getUser());
            $manager->persist($commentaire);
            $manager->flush();
        }

        return $this->render('film/details.html.twig', [
            'film' => $film,
            'commentaire_form' => $commentaireForm->createView()
        ]);
    }

    /**
     * @Route("/film/search", name="film_search")
     */
    public function searchFilm(Request $request, FilmRepository $filmRepository)
    {
        $q = $request->get('q');
        //dd($q);//dump and die
        $results = $filmRepository->searchFilm($q);

        return $this->render('film/search_result.html.twig', [
            'search' => $q,
            'results'=> $results

        ]);
    }
}
