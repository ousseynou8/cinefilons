<?php

namespace App\Controller;

use App\Allocine\AllocineApi;
use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(FilmRepository $filmRepository, AllocineApi $allocineApi)
    {
        $list = $allocineApi->getMovieList();
        //dd(json_decode($list));
        $data = $filmRepository->findAll();
        $topNouveaute = $filmRepository->findBy([], ['dateDeSortie' => 'DESC', 'note' => 'DESC'], 8);
        $topFilmsUs = $filmRepository->findBy(['nationalite' => 'U.S.A.'], ['note' => 'DESC'], 4);
        $topFilmsFrancais = $filmRepository->findBy(['nationalite' => 'France'], ['note' => 'DESC'], 4);
        $topFilmsEnfants = $filmRepository->findBy(['classification' => 'A partir de 3 ans'], ['note' => 'DESC'], 4);
        //dump($data['feed']['movie'][0]['production']);
        //dd(json_decode($data));
        return $this->render('home/index.html.twig', [
            'list_films' => $data,
            'top_nouveaute' => $topNouveaute,
            'top_us' => $topFilmsUs,
            'top_francais' => $topFilmsFrancais,
            'top_filmsenfants' => $topFilmsEnfants
        ]);
    }

    /**
     * @Route ("/conditions", name="conditions")
     *
     */
    public function condition()
    {
        return $this->render('home/conditions.html.twig');
    }
}


