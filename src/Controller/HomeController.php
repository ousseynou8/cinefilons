<?php

namespace App\Controller;

use App\Allocine\AllocineApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(AllocineApi $allocine)
    {
        $data = $allocine->getMovieList();
        //dump($data['feed']['movie'][0]['production']);
        //dd(json_decode($data));
        return $this->render('home/index.html.twig', [
            'list_films' => $data,
        ]);
    }
}
