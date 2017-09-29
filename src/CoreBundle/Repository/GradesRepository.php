<?php

namespace CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use CoreBundle\Services\Crud\BuildInterface\CrudInterface;

/**
 * GradesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GradesRepository extends EntityRepository
{

    public function findGradesByCourseAndUser($courseId, $studentId)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT grades
            FROM CoreBundle:Grades grades
            WHERE
            grades.courseId = :course_id AND
            grades.userId = :student_id
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('course_id', $courseId);
        $query->setParameter('student_id', $studentId);

        return $query->getResult();
    }

}
