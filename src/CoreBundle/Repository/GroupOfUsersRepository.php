<?php

namespace CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use CoreBundle\Services\BoxOneToManyGroup\BuildInterface\BoxOneToManyGroupInterface;

/**
 * GroupOfUsersRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GroupOfUsersRepository extends EntityRepository implements BoxOneToManyGroupInterface
{

    public function findAll($limit = null, $offset = null)
    {
        return $this->findBy(['isActive' => 1], ['idIncrement' => 'DESC'], $limit, $offset);
    }

    public function findOneById($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT groupUser
            FROM CoreBundle:GroupOfUsers groupUser
            WHERE
            groupUser.idIncrement = :id AND
            groupUser.isActive = :status
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('status', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function search($q, $maxResults = null, $firstResult = null)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT groupUser
            FROM CoreBundle:GroupOfUsers groupUser
            WHERE
            (groupUser.idIncrement LIKE :q OR groupUser.groupName LIKE :q) AND
            groupUser.isActive = :active
            ORDER BY groupUser.idIncrement DESC
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('q', '%' . $q . '%');

        if($maxResults){
            $query->setMaxResults($maxResults);
        }

        if($firstResult){
            $query->setFirstResult($firstResult);
        }

        return $query->getResult();
    }

    public function findAllByBoxLeftId($boxLeftId)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT groupUser, userTianos
            FROM CoreBundle:GroupOfUsers groupUser
            INNER JOIN groupUser.user userTianos
            WHERE
            groupUser.idIncrement = :id AND
            groupUser.isActive = :status
            ORDER BY userTianos.idIncrement DESC
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('status', 1);
        $query->setParameter('id', $boxLeftId);

        return $query->getResult();
    }

}
