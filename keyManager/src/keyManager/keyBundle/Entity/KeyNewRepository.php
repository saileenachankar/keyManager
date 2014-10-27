<?php

namespace keyManager\keyBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * KeyNewRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class KeyNewRepository extends EntityRepository
{
    public function getkeys($id)
    {
        $qb = $this->createQueryBuilder('k')
            ->select('k')
            ->where('k.tpenew = :id')
            ->setParameter('id',$id);
        return $qb->getQuery()
            ->getResult();
    }

    public function createQuery($string)
    {
        // TODO: Implement createQuery() method.
    }
}