<?php

namespace Film\FilmBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ActorRepository extends EntityRepository
{
    public function getActors($limit)
    {
        return $this->createQueryBuilder('c')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
