<?php

namespace Film\FilmBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FilmRepository extends EntityRepository
{
    public function getFilmsByCategoryId($categoryId)
    {
        return $this->createQueryBuilder('u')
            ->innerJoin('u.category', 'c')
            ->where('c.id = :categoryId')
            ->setParameter('categoryId', $categoryId)
            ->getQuery()->getResult();
    }

    public function getFilmsByActorId($actorId)
    {
        return $this->createQueryBuilder('u')
            ->innerJoin('u.actor', 'a')
            ->where('a.id = :actorId')
            ->setParameter('actorId', $actorId)
            ->getQuery()->getResult();
    }
}
