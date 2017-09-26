<?php

namespace CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use CoreBundle\Services\Crud\BuildInterface\CrudInterface;

/**
 * CourseRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CourseRepository extends EntityRepository
{

    public function findAll($limit = null, $offset = null)
    {
        return $this->findBy(['isActive' => 1], ['idIncrement' => 'DESC'], $limit, $offset);
    }

    public function search($q, $maxResults = null, $firstResult = null)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT course
            FROM CoreBundle:Course course
            WHERE
            (course.idIncrement LIKE :q OR course.name LIKE :q) AND
            course.isActive = :active
            ORDER BY course.idIncrement DESC
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

    public function findOneById($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT course
            FROM CoreBundle:Course course
            WHERE
            course.idIncrement = :id AND
            course.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

}