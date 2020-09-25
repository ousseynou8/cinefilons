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
    public function index(FilmRepository $filmRepository)
    {
        $data = $filmRepository->findAll();
        //dump($data['feed']['movie'][0]['production']);
        //dd(json_decode($data));
        return $this->render('home/index.html.twig', [
            'list_films' => $data,
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


