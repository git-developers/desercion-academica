<?php

namespace CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use CoreBundle\Services\Crud\BuildInterface\CrudInterface;

/**
 * AssistanceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AssistanceRepository extends EntityRepository
{

    public function findAll($limit = null, $offset = null)
    {
        return $this->findBy(['isActive' => 1], ['idIncrement' => 'DESC'], $limit, $offset);
    }

    public function findOneById($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT assistance
            FROM CoreBundle:Assistance assistance
            WHERE
            assistance.idIncrement = :id AND
            assistance.status = :status
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('status', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function findAllByUser($userId, $dateAssistance)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT assistance, user_
            FROM CoreBundle:Assistance assistance
            LEFT JOIN assistance.user user_
            WHERE
            user_.id = :userId AND
            user_.enabled = :enabled AND
            SUBSTRING(assistance.createdAt, 1, 10) = :dateAssistance
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('enabled', 1);
        $query->setParameter('userId', $userId);
        $query->setParameter('dateAssistance', $dateAssistance);

        return $query->getResult();
    }
}