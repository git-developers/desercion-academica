<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;

/**
 * AclObjectIdentities
 *
 * @ORM\Table(name="acl_object_identities", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_9407E5494B12AD6EA000B10", columns={"object_identifier", "class_id"})}, indexes={@ORM\Index(name="IDX_9407E54977FA751A", columns={"parent_object_identity_id"})})
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\AclObjectIdentitiesRepository")
 */
class AclObjectIdentities
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSS\Groups({"acl_object_identities"})
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="class_id", type="integer", nullable=false)
     * @JMSS\Groups({"acl_object_identities"})
     */
    private $classId;

    /**
     * @var string
     *
     * @ORM\Column(name="object_identifier", type="string", length=100, nullable=false)
     * @JMSS\Groups({"acl_object_identities"})
     */
    private $objectIdentifier;

    /**
     * @var boolean
     *
     * @ORM\Column(name="entries_inheriting", type="boolean", nullable=false)
     * @JMSS\Groups({"acl_object_identities"})
     */
    private $entriesInheriting;

    /**
     * @var \CoreBundle\Entity\AclObjectIdentities
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\AclObjectIdentities")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_object_identity_id", referencedColumnName="id")
     * })
     * @JMSS\Groups({"acl_object_identities"})
     */
    private $parentObjectentity;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\AclObjectIdentities", inversedBy="objectentity")
     * @ORM\JoinTable(name="acl_object_identity_ancestors",
     *   joinColumns={
     *     @ORM\JoinColumn(name="object_identity_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ancestor_id", referencedColumnName="id")
     *   }
     * )
     */
    private $ancestor;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ancestor = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set classId
     *
     * @param integer $classId
     *
     * @return AclObjectIdentities
     */
    public function setClassId($classId)
    {
        $this->classId = $classId;

        return $this;
    }

    /**
     * Get classId
     *
     * @return integer
     */
    public function getClassId()
    {
        return $this->classId;
    }

    /**
     * Set objectIdentifier
     *
     * @param string $objectIdentifier
     *
     * @return AclObjectIdentities
     */
    public function setObjectIdentifier($objectIdentifier)
    {
        $this->objectIdentifier = $objectIdentifier;

        return $this;
    }

    /**
     * Get objectIdentifier
     *
     * @return string
     */
    public function getObjectIdentifier()
    {
        return $this->objectIdentifier;
    }

    /**
     * Set entriesInheriting
     *
     * @param boolean $entriesInheriting
     *
     * @return AclObjectIdentities
     */
    public function setEntriesInheriting($entriesInheriting)
    {
        $this->entriesInheriting = $entriesInheriting;

        return $this;
    }

    /**
     * Get entriesInheriting
     *
     * @return boolean
     */
    public function getEntriesInheriting()
    {
        return $this->entriesInheriting;
    }

    /**
     * Set parentObjectentity
     *
     * @param \CoreBundle\Entity\AclObjectIdentities $parentObjectentity
     *
     * @return AclObjectIdentities
     */
    public function setParentObjectentity(\CoreBundle\Entity\AclObjectIdentities $parentObjectentity = null)
    {
        $this->parentObjectentity = $parentObjectentity;

        return $this;
    }

    /**
     * Get parentObjectentity
     *
     * @return \CoreBundle\Entity\AclObjectIdentities
     */
    public function getParentObjectentity()
    {
        return $this->parentObjectentity;
    }

    /**
     * Add ancestor
     *
     * @param \CoreBundle\Entity\AclObjectIdentities $ancestor
     *
     * @return AclObjectIdentities
     */
    public function addAncestor(\CoreBundle\Entity\AclObjectIdentities $ancestor)
    {
        $this->ancestor[] = $ancestor;

        return $this;
    }

    /**
     * Remove ancestor
     *
     * @param \CoreBundle\Entity\AclObjectIdentities $ancestor
     */
    public function removeAncestor(\CoreBundle\Entity\AclObjectIdentities $ancestor)
    {
        $this->ancestor->removeElement($ancestor);
    }

    /**
     * Get ancestor
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAncestor()
    {
        return $this->ancestor;
    }
}
