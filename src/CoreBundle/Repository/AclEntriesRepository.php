<?php

namespace CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * AclEntriesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AclEntriesRepository extends EntityRepository
{

    public function findAll()
    {
        $em = $this->getEntityManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare("
            SELECT 
                t1.id id_entries,
                t1.*, 
                t2.object_identifier,
                t4.class_type, 
                t5.username user_username, t5.name user_name, t5.email user_email
                FROM acl_entries AS t1
                INNER JOIN acl_object_identities AS t2
                INNER JOIN acl_security_identities AS t3
                INNER JOIN acl_classes AS t4
                INNER JOIN user_tianos AS t5
            WHERE
                t1.object_identity_id = t2.id AND
                t1.security_identity_id = t3.id AND
                t1.class_id = t4.id AND 
                SUBSTRING_INDEX(t3.identifier, 'User-', 0 -1) = t5.username
            ORDER BY t1.id DESC
            
        ");

//        $statement->bindValue('id', 123);
        $statement->execute();
        return $statement->fetchAll();

    }


}
