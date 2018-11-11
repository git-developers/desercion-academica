<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;

/**
 * Assistance
 *
 * @ORM\Table(name="assistance", indexes={@ORM\Index(name="fk_assistance_user_tianos1_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class Assistance
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idIncrement;

    /**
     * @var boolean
     *
     * @ORM\Column(name="attended", type="boolean", nullable=true)
     */
    private $attended;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @JMSS\Type("DateTime<'Y-m-d H:i'>")
     * @JMSS\Groups({"assistance"})
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive;

    /**
     * @var \CoreBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;


    /**
     * Set idIncrement
     *
     * @param integer $idIncrement
     *
     * @return Assistance
     */
    public function setIdIncrement($idIncrement)
    {
        $this->idIncrement = $idIncrement;

        return $this;
    }

    /**
     * Get idIncrement
     *
     * @return integer
     */
    public function getIdIncrement()
    {
        return $this->idIncrement;
    }

    /**
     * Set attended
     *
     * @param boolean $attended
     *
     * @return Assistance
     */
    public function setAttended($attended)
    {
        $this->attended = $attended;

        return $this;
    }

    /**
     * Get attended
     *
     * @return boolean
     */
    public function getAttended()
    {
        return $this->attended;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Category
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Category
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Assistance
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set user
     *
     * @param \CoreBundle\Entity\User $user
     *
     * @return Assistance
     */
    public function setUser(\CoreBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \CoreBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
