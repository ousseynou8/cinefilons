<?php

namespace App\Command;

use Goutte\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DomCrawler\Crawler;

class TestScrapCommand extends Command
{
    protected static $defaultName = 'app:test-scrap';


    protected function configure()
    {
        $this
            ->setDescription('Test scrapping')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $client = new Client();

        //$crawler = $client->request('GET', 'http://www.allocine.fr/film/fichefilm-266297/photos/');

        //$photos = $crawler->filter('.shot-item .shot-img');

        //for($i = 0; $i<$photos->count(); $i++) {
          //  dump(str_replace('/c_300_300', '', $photos->getNode s($i)->attributes->getNamedItem('data-src')->nodeValue));
        //}

        //$crawler = $client->request('GET', 'http://www.allocine.fr/film/fichefilm-266297/critiques/presse');

        /* $texts = $crawler->filter('.reviews-press-comment .item .text');
        $newspapers = $crawler->filter('.reviews-press-comment .item .title');

        for($i = 0; $i<$texts->count(); $i++) {
            dump($newspapers->getNode($i)->textContent);
            dump($texts->getNode($i)->textContent);
        }*/

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
