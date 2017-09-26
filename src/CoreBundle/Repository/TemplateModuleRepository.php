<?php

namespace CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use CoreBundle\Services\Crud\BuildInterface\CrudInterface;

/**
 * TemplateModuleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TemplateModuleRepository extends EntityRepository implements CrudInterface
{
    public function findAll($limit = null, $offset = null)
    {
//        $em = $this->getEntityManager();
//        $dql = "
//            SELECT templateModule
//            FROM CoreBundle:TemplateModule templateModule
//            WHERE
//            templateModule.isActive = :active
//            ORDER BY templateModule.moduleOrder DESC
//            ";
//
//        $query = $em->createQuery($dql);
//        $query->setParameter('active', 1);
//
//        return $query->getResult();


        return $this->findBy(['isActive' => 1], ['moduleOrder' => 'ASC'], $limit, $offset);
    }

    public function findOneById($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT templatePage
            FROM CoreBundle:TemplateModule templateModule
            WHERE
            templateModule.idIncrement = :id AND
            templateModule.status = :status
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('status', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function findAllObjects()
    {
        return $this->createQueryBuilder('a')
            ->where('a.isActive = :active')
            ->orderBy('a.moduleOrder', 'ASC')
            ->setParameter('active', true)
            ;
    }

    public function findAllObjectsExclude($moduleId)
    {
        return $this->createQueryBuilder('a')
            ->where('a.isActive = :active AND a.idIncrement NOT IN (:module)')
            ->orderBy('a.moduleOrder', 'ASC')
            ->setParameter('active', true)
            ->setParameter('module', [$moduleId])
            ;
    }
}
