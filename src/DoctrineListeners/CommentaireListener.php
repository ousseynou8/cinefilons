<?php


namespace App\DoctrineListeners;


use App\Entity\Commentaire;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;

class CommentaireListener implements EventSubscriberInterface
{

    public function getSubscribedEvents()
    {
        return [
            'postPersist'
        ];
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $commentaire = $args->getEntity();
        if( ! ($commentaire instanceof Commentaire)) {
            return;
        }
        $film = $commentaire->getFilm();
        $sum = 0;
        foreach ($film->getCommentaires() as $c) {
            $sum += $c->getNote();
        }

        $film->setNote(round($sum / $film->getCommentaires()->count()));
        $args->getEntityManager()->persist($film);
        $args->getEntityManager()->flush();
    }
}