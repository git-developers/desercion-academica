<?php

namespace CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use CoreBundle\Services\Crud\BuildInterface\CrudInterface;

/**
 * ProfileRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProfileRepository extends EntityRepository implements CrudInterface
{

    public function findAll($limit = null, $offset = null)
    {
        return $this->findBy(['isActive' => 1], ['idIncrement' => 'DESC'], $limit, $offset);
    }

    public function findAllByParent($parent)
    {
        // TODO: Implement findAllByParent() method.
    }

    public function findOneByIdIncrement($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT profile, role
            FROM CoreBundle:Profile profile
            LEFT JOIN profile.role role
            WHERE
            profile.idIncrement = :id AND
            profile.isActive = :isActive
            ORDER BY role.idIncrement DESC
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('isActive', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function findOneById($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT profile
            FROM CoreBundle:Profile profile
            WHERE
            profile.idIncrement = :id AND
            profile.isActive = :isActive
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('isActive', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}