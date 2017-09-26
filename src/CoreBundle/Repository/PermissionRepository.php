<?php

namespace CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PermissionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PermissionRepository extends EntityRepository
{

    public function findAll()
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT permission
            FROM CoreBundle:Permission permission
            WHERE
            permission.active = :active
            ORDER BY permission.groupPermissionTag DESC
            ";// , permission.idIncrement

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);

        return $query->getResult();
    }

    public function findOneById($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT permission
            FROM CoreBundle:Permission permission
            WHERE
            permission.idIncrement = :id AND
            permission.active = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
