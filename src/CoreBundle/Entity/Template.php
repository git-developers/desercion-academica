<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMSS;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Template
 *
 * @ORM\Table(name="template",
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(name="code_UNIQUE", columns={"code"})
 *     }
 * )
 *
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\TemplateRepository")
 *
 * @UniqueEntity(
 *     fields={"code"},
 *     message="El code fue registrado anteriormente"
 * )
 */
class Template
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSS\Groups({"template", "template_has_module"})
     */
    private $idIncrement;

    /**
     * @var integer
     *
     * @ORM\Column(name="code", type="integer", nullable=false)
     * @JMSS\Groups({"template"})
     * @Assert\Type(
     *     type="integer",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @Assert\GreaterThan(
     *     value = 0
     * )
     * @Assert\LessThan(
     *     value = 15,
     *     message="El valor tiene que ser menor a {{ compared_value }}"
     * )
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     * @JMSS\Groups({"template", "template_has_module"})
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @JMSS\Type("DateTime<'Y-m-d H:i'>")
     * @JMSS\Groups({"template"})
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
     * @ORM\Column(name="is_active_template", type="boolean", nullable=true)
     * @JMSS\Groups({"template"})
     */
    private $isActiveTemplate = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive = '1';

    /**
     * @var string
     *
     * @JMSS\Accessor(getter="getNameBox", setter="setNameBox")
     * @JMSS\Groups({"template"})
     */
    private $nameBox;

    public function __toString() {
        return sprintf('%s - %s', $this->idIncrement, $this->name);
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
     * Set code
     *
     * @param integer $code
     *
     * @return Template
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Template
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Template
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
     * @return Template
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
     * Set isActiveTemplate
     *
     * @param boolean $isActiveTemplate
     *
     * @return Template
     */
    public function setIsActiveTemplate($isActiveTemplate)
    {
        $this->isActiveTemplate = $isActiveTemplate;

        return $this;
    }

    /**
     * Get isActiveTemplate
     *
     * @return boolean
     */
    public function getIsActiveTemplate()
    {
        return $this->isActiveTemplate;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Template
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
     *
     * @return string
     */
    public function getNameBox()
    {
        return sprintf('%s', $this->name);
    }

    /**
     * @param string $nameBox
     */
    public function setNameBox($nameBox)
    {
        $this->nameBox = $nameBox;
    }
}
