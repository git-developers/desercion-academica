<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\SerializedName;

//     * @SerializedName("DT_RowId")

/**
 * Role
 *
 * @ORM\Table(name="role")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\RoleRepository")
 */
class Role
{

    const ROLE_TEMPLATESETUP = 'ROLE_TEMPLATESETUP';


    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSS\Groups({"role", "profile"})
     */
    private $idIncrement;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     * @JMSS\Groups({"role", "profile"})
     * @Assert\Regex(
     *     pattern="/[^a-zA-Z_ ]+/",
     *     match=false,
     *     message="El nombre solo debe de tener texto"
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100, nullable=false)
     * @JMSS\Groups({"role"})
     * @Assert\Regex(
     *     pattern="/[^a-zA-Z_ ]+/",
     *     match=false,
     *     message="Su slug solo debe de tener texto"
     * )
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="group_rol", type="string", length=100, nullable=true)
     * @JMSS\Groups({"role"})
     */
    private $groupRol;

    /**
     * @var string
     *
     * @ORM\Column(name="group_rol_tag", type="string", length=100, nullable=true)
     * @JMSS\Groups({"role"})
     */
    private $groupRolTag;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @JMSS\Type("DateTime<'Y-m-d H:i'>")
     * @JMSS\Groups({"role"})
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
    private $isActive = 1;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\Profile", mappedBy="role")
     */
    private $profile;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->profile = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return sprintf('(%s) %s', $this->idIncrement, $this->name);
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
     * Set name
     *
     * @param string $name
     *
     * @return Role
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Role
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set groupRol
     *
     * @param string $groupRol
     *
     * @return Role
     */
    public function setGroupRol($groupRol)
    {
        $this->groupRol = $groupRol;

        return $this;
    }

    /**
     * Get groupRol
     *
     * @return string
     */
    public function getGroupRol()
    {
        return $this->groupRol;
    }

    /**
     * Set groupRolTag
     *
     * @param string $groupRolTag
     *
     * @return Role
     */
    public function setGroupRolTag($groupRolTag)
    {
        $this->groupRolTag = $groupRolTag;

        return $this;
    }

    /**
     * Get groupRolTag
     *
     * @return string
     */
    public function getGroupRolTag()
    {
        return $this->groupRolTag;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Role
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
     * @return Role
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
     * @return Profile
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
     * Add profile
     *
     * @param \CoreBundle\Entity\Profile $profile
     *
     * @return Role
     */
    public function addProfile(\CoreBundle\Entity\Profile $profile)
    {
        $this->profile[] = $profile;

        return $this;
    }

    /**
     * Remove profile
     *
     * @param \CoreBundle\Entity\Profile $profile
     */
    public function removeProfile(\CoreBundle\Entity\Profile $profile)
    {
        $this->profile->removeElement($profile);
    }

    /**
     * Get profile
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProfile()
    {
        return $this->profile;
    }
}
