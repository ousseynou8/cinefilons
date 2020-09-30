<?php

namespace App\Controller;


use App\Entity\Film;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\FilmRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    /**
     * @Route("/film/{id<\d+>}", name="film")
     */

    public function index(Film $film)
    {
        return $this->render('film/details.html.twig', [
            'film' => $film
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
