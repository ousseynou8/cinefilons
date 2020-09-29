<?php

namespace App\Command;

use App\Allocine\AllocineApi;
use App\Entity\Film;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Goutte\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ScrapAllocineApiCommand extends Command
{
    protected static $defaultName = 'app:scrap';

    /**
     * @var EntityManagerInterface
     */
    private $objectManager;

    /**
     * @var AllocineApi
     */
    private $allocine;

    /**
     * @var FilmRepository
     */
    private $filmRepository;

    /**
     * ScrapAllocineApiCommand constructor.
     * @param EntityManagerInterface $objectManager
     */
    public function __construct(EntityManagerInterface $objectManager, AllocineApi $allocine, FilmRepository $filmRepository)
    {
        parent::__construct(self::$defaultName);
        $this->objectManager = $objectManager;
        $this->allocine = $allocine;
        $this->filmRepository = $filmRepository;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
//            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
//            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $io = new SymfonyStyle($input, $output);
//        $arg1 = $input->getArgument('arg1');
//
//        if ($arg1) {
//            $io->note(sprintf('You passed an argument: %s', $arg1));
//        }

//        if ($input->getOption('option1')) {
//            // ...
//        }

        $json = $this->allocine->getMovieList(100);

        $data = json_decode($json, true);

        foreach ($data['feed']['movie'] as $movieApi) {
            $movie = $this->filmRepository->findOneBy(['codeAllocine' => $movieApi['code']]);

            $movie = $movie ?: new Film();

            $movie->setTitre($movieApi['originalTitle']);
            if(isset($movieApi['movieCertificate'])) {
                $movie->setClassification($movieApi['movieCertificate']['certificate']['$']);
            }
            if(isset($movieApi['link'])) {
                foreach ($movieApi['link'] as $link) {
                    if($link['rel'] === 'aco:web_pressreviews') {
                        $movie->setCritiquesPresse($link['href']);
                        break;
                    }
                }
            }
            $movie->setDateDeSortie($movieApi['release']['releaseDate']);

            if(isset($movieApi['castingShort']['directors'])) {
                $movie->setRealisateurs($movieApi['castingShort']['directors']);
            }

            if(isset($movieApi['castingShort']['actors'])) {
                $movie->setActeurs($movieApi['castingShort']['actors']);
            }

            if(isset($movieApi['trailerEmbed'])) {
                $movie->setTrailer($movieApi['trailerEmbed']);
            }


            if(isset($movieApi['synopsisShort'])) {
                $movie->setSynopsis($movieApi['synopsisShort']);
            }

            $movie->setType($movieApi['genre'][0]['$']);
            $movie->setPoster($movieApi['poster']['href']);
            $movie->setNote(0);
            $movie->setCodeAllocine($movieApi['code']);

            if(isset($movieApi['nationality'][0]['$'])){
            $movie->setNationalite($movieApi['nationality'][0]['$']);
            }

            $movie->setSeances($movieApi['link'][3]['href']);
            $movie->setCritiquesSpectateurs($movieApi['link'][4]['href']);
            $movie->setCritiquesPresse($movieApi['link'][5]['href']);


            //$io = new SymfonyStyle($input, $output);
            $client = new Client();
            $crawler = $client->request('GET', $movieApi['link'][6]['href']) ;
            $photos = $crawler->filter('.shot-item .shot-img');
            $urls = [];
            for($i = 0; $i<$photos->count(); $i++) {
                $urls[] = str_replace('/c_300_300', '', $photos->getNode($i)->attributes->getNamedItem('data-src')->nodeValue);
            }
            $movie->setPhotos($urls);




            if(isset($movieApi['link'][7]['href'])) {
                $movie->setVideos($movieApi['link'][7]['href']);
            }

            if(isset($movieApi['link'][1]['href'])) {
                $movie->setCasting($movieApi['link'][1]['href']);
            }

            $this->objectManager->persist($movie);
        }

        $this->objectManager->flush();

        $io->success('Hello world');

        return Command::SUCCESS;
    }
}
