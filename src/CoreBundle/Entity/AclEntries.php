<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;

/**
 * AclEntries
 *
 * @ORM\Table(name="acl_entries", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_46C8B806EA000B103D9AB4A64DEF17BCE4289BF4", columns={"class_id", "object_identity_id", "field_name", "ace_order"})}, indexes={@ORM\Index(name="IDX_46C8B806EA000B103D9AB4A6DF9183C9", columns={"class_id", "object_identity_id", "security_identity_id"}), @ORM\Index(name="IDX_46C8B806EA000B10", columns={"class_id"}), @ORM\Index(name="IDX_46C8B8063D9AB4A6", columns={"object_identity_id"}), @ORM\Index(name="IDX_46C8B806DF9183C9", columns={"security_identity_id"})})
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\AclEntriesRepository")
 */
class AclEntries
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSS\Groups({"acl_entries"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="field_name", type="string", length=50, nullable=true)
     * @JMSS\Groups({"acl_entries"})
     */
    private $fieldName;

    /**
     * @var integer
     *
     * @ORM\Column(name="ace_order", type="smallint", nullable=false)
     * @JMSS\Groups({"acl_entries"})
     */
    private $aceOrder;

    /**
     * @var integer
     *
     * @ORM\Column(name="mask", type="integer", nullable=false)
     * @JMSS\Groups({"acl_entries"})
     */
    private $mask;

    /**
     * @var boolean
     *
     * @ORM\Column(name="granting", type="boolean", nullable=false)
     * @JMSS\Groups({"acl_entries"})
     */
    private $granting;

    /**
     * @var string
     *
     * @ORM\Column(name="granting_strategy", type="string", length=30, nullable=false)
     * @JMSS\Groups({"acl_entries"})
     */
    private $grantingStrategy;

    /**
     * @var boolean
     *
     * @ORM\Column(name="audit_success", type="boolean", nullable=false)
     * @JMSS\Groups({"acl_entries"})
     */
    private $auditSuccess;

    /**
     * @var boolean
     *
     * @ORM\Column(name="audit_failure", type="boolean", nullable=false)
     * @JMSS\Groups({"acl_entries"})
     */
    private $auditFailure;

    /**
     * @var \CoreBundle\Entity\AclObjectIdentities
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\AclObjectIdentities")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="object_identity_id", referencedColumnName="id")
     * })
     * @JMSS\Groups({"acl_entries"})
     */
    private $objectentity;

    /**
     * @var \CoreBundle\Entity\AclSecurityIdentities
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\AclSecurityIdentities")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="security_identity_id", referencedColumnName="id")
     * })
     * @JMSS\Groups({"acl_entries"})
     */
    private $securityentity;

    /**
     * @var \CoreBundle\Entity\AclClasses
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\AclClasses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="class_id", referencedColumnName="id")
     * })
     * @JMSS\Groups({"acl_entries"})
     */
    private $class;



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
     * Set fieldName
     *
     * @param string $fieldName
     *
     * @return AclEntries
     */
    public function setFieldName($fieldName)
    {
        $this->fieldName = $fieldName;

        return $this;
    }

    /**
     * Get fieldName
     *
     * @return string
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * Set aceOrder
     *
     * @param integer $aceOrder
     *
     * @return AclEntries
     */
    public function setAceOrder($aceOrder)
    {
        $this->aceOrder = $aceOrder;

        return $this;
    }

    /**
     * Get aceOrder
     *
     * @return integer
     */
    public function getAceOrder()
    {
        return $this->aceOrder;
    }

    /**
     * Set mask
     *
     * @param integer $mask
     *
     * @return AclEntries
     */
    public function setMask($mask)
    {
        $this->mask = $mask;

        return $this;
    }

    /**
     * Get mask
     *
     * @return integer
     */
    public function getMask()
    {
        return $this->mask;
    }

    /**
     * Set granting
     *
     * @param boolean $granting
     *
     * @return AclEntries
     */
    public function setGranting($granting)
    {
        $this->granting = $granting;

        return $this;
    }

    /**
     * Get granting
     *
     * @return boolean
     */
    public function getGranting()
    {
        return $this->granting;
    }

    /**
     * Set grantingStrategy
     *
     * @param string $grantingStrategy
     *
     * @return AclEntries
     */
    public function setGrantingStrategy($grantingStrategy)
    {
        $this->grantingStrategy = $grantingStrategy;

        return $this;
    }

    /**
     * Get grantingStrategy
     *
     * @return string
     */
    public function getGrantingStrategy()
    {
        return $this->grantingStrategy;
    }

    /**
     * Set auditSuccess
     *
     * @param boolean $auditSuccess
     *
     * @return AclEntries
     */
    public function setAuditSuccess($auditSuccess)
    {
        $this->auditSuccess = $auditSuccess;

        return $this;
    }

    /**
     * Get auditSuccess
     *
     * @return boolean
     */
    public function getAuditSuccess()
    {
        return $this->auditSuccess;
    }

    /**
     * Set auditFailure
     *
     * @param boolean $auditFailure
     *
     * @return AclEntries
     */
    public function setAuditFailure($auditFailure)
    {
        $this->auditFailure = $auditFailure;

        return $this;
    }

    /**
     * Get auditFailure
     *
     * @return boolean
     */
    public function getAuditFailure()
    {
        return $this->auditFailure;
    }

    /**
     * Set objectentity
     *
     * @param \CoreBundle\Entity\AclObjectIdentities $objectentity
     *
     * @return AclEntries
     */
    public function setObjectentity(\CoreBundle\Entity\AclObjectIdentities $objectentity = null)
    {
        $this->objectentity = $objectentity;

        return $this;
    }

    /**
     * Get objectentity
     *
     * @return \CoreBundle\Entity\AclObjectIdentities
     */
    public function getObjectentity()
    {
        return $this->objectentity;
    }

    /**
     * Set securityentity
     *
     * @param \CoreBundle\Entity\AclSecurityIdentities $securityentity
     *
     * @return AclEntries
     */
    public function setSecurityentity(\CoreBundle\Entity\AclSecurityIdentities $securityentity = null)
    {
        $this->securityentity = $securityentity;

        return $this;
    }

    /**
     * Get securityentity
     *
     * @return \CoreBundle\Entity\AclSecurityIdentities
     */
    public function getSecurityentity()
    {
        return $this->securityentity;
    }

    /**
     * Set class
     *
     * @param \CoreBundle\Entity\AclClasses $class
     *
     * @return AclEntries
     */
    public function setClass(\CoreBundle\Entity\AclClasses $class = null)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return \CoreBundle\Entity\AclClasses
     */
    public function getClass()
    {
        return $this->class;
    }
}
