<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MigrationVersions
 *
 * @ORM\Table(name="migration_versions")
 * @ORM\Entity
 */
class MigrationVersions
{
    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $version;


}

