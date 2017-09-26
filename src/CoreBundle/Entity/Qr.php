<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Qr
 *
 * @ORM\Table(name="qr")
 * @ORM\Entity
 */
class Qr
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idIncrement;

    /**
     * @var string
     *
     * @ORM\Column(name="cht", type="string", length=45, precision=0, scale=0, nullable=false, unique=false)
     */
    private $cht;

    /**
     * @var string
     *
     * @ORM\Column(name="chl", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $chl;

    /**
     * @var string
     *
     * @ORM\Column(name="chs", type="string", length=45, precision=0, scale=0, nullable=false, unique=false)
     */
    private $chs;

    /**
     * @var string
     *
     * @ORM\Column(name="choe", type="string", length=45, precision=0, scale=0, nullable=true, unique=false)
     */
    private $choe;

    /**
     * @var string
     *
     * @ORM\Column(name="chld", type="string", length=45, precision=0, scale=0, nullable=true, unique=false)
     */
    private $chld;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $updated;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $status;


}

