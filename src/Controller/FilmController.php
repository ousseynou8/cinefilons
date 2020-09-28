<?php

namespace App\Controller;

use App\Entity\Film;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    /**
     * @Route("/film/{id<\d+>}", name="film")
     */

    public function index(Film $film)
    {
        return $this->render('film/details.html.twig', [
            'film' => $film,
        ]);
    }
}
