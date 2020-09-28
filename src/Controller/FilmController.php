<?php

namespace App\Controller;

use App\Repository\FilmRepository;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    /**
     * @Route("/film", name="film")
     */
    public function index()
    {
        return $this->render('film/index.html.twig', [
            'controller_name' => 'FilmController',
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
