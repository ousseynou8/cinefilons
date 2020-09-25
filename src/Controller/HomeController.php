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
        $topNouveaute = $filmRepository->findBy([], ['dateDeSortie' => 'DESC', 'note' => 'DESC'], 10);
        //dump($data['feed']['movie'][0]['production']);
        //dd(json_decode($data));
        return $this->render('home/index.html.twig', [
            'list_films' => $data,
            'top_nouveaute' => $topNouveaute
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


