<?php

namespace App\EventSubscriber;

use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;

class HashUserPasswordSubscriber implements EventSubscriberInterface
{
    public function getSubscribedEvents()
    {
        return
            [

            ];
    }
}