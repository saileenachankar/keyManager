<?php

namespace keyManager\keyBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ClientNewRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ClientNewRepository extends EntityRepository
{
    public function getAllClients($limit = null)
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c');

        return $qb->getQuery()
            ->getResult();
    }

    public function getSingleClient($clientname)
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.clientCompany = :clientname')
            ->setParameter('clientname',$clientname);
        return $qb->getQuery()
            ->getResult();

    }

    public function addNewClient($clientname)
    {
        $qb = $this->createQueryBuilder('c')
            ->update('keyManagerkeyBundle:ClientNew','c')
            ->set('c.clientCompany' , '?1')
            ->setParameter(1,$clientname);

        return $qb->getQuery();

    }

    public function getexceptselected($id)
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.id != :id')
            ->setParameter('id',$id);

        return $qb->getQuery()
            ->getResult();
    }


}
