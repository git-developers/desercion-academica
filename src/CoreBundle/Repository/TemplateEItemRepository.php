<?php

namespace CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * TemplateEItemRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TemplateEItemRepository extends EntityRepository
{

    public function findAll($limit = null, $offset = null)
    {
        return $this->findBy(['isActive' => 1], ['idIncrement' => 'DESC'], $limit, $offset);
    }

    public function findAllByTemplateHasModule($templateHasModuleId)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT item
            FROM CoreBundle:TemplateEItem item
            INNER JOIN item.templateHasModule templateHasModule
            WHERE
            templateHasModule.idIncrement = :id AND
            item.isActive = :active
            ORDER BY item.idIncrement DESC
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $templateHasModuleId);

        return $query->getResult();
    }

}