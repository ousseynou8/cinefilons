<?php

namespace App\Command;

use App\Allocine\AllocineApi;
use App\Entity\Film;
use Doctrine\ORM\EntityManagerInterface;
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
     * ScrapAllocineApiCommand constructor.
     * @param EntityManagerInterface $objectManager
     */
    public function __construct(EntityManagerInterface $objectManager, AllocineApi $allocine)
    {
        parent::__construct(self::$defaultName);
        $this->objectManager = $objectManager;
        $this->allocine = $allocine;
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

        $json = $this->allocine->getMovieList();

        $data = json_decode($json, true);

        foreach ($data['feed']['movie'] as $movieApi) {
            $movie = new Film();
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
            $movie->setSynopsis($movieApi['synopsisShort']);
            $movie->setType($movieApi['genre'][0]['$']);
            $movie->setPoster($movieApi['poster']['href']);
            $movie->setNote(0);
            $movie->setNationalite($movieApi['nationality'][0]['$']);
            $this->objectManager->persist($movie);
        }

        $this->objectManager->flush();

        $io->success('Hello world');

        return Command::SUCCESS;
    }
}
