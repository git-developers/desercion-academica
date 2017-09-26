<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;


/**
 * TemplateModule
 *
 * @ORM\Table(name="template_module")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\TemplateModuleRepository")
 */
class TemplateModule
{

    const BLOG = 'BLOG';
    const INDEX = 'INDEX';
    const ITEM = 'ITEM';
    const PARAGRAPH = 'PARAGRAPH';
    const BLOG_POST = 'BLOG_POST';

    const TYPE_CHOICES = [
        self::INDEX => self::INDEX,
        self::PARAGRAPH => self::PARAGRAPH,
        self::ITEM => self::ITEM,
        self::BLOG => self::BLOG,
        self::BLOG_POST => self::BLOG_POST,
    ];

    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSS\Groups({"template_module", "template_has_module", "template_frontend"})
     */
    private $idIncrement;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=45, nullable=true)
     * @JMSS\Groups({"template_module"})
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="module_order", type="integer", nullable=false)
     * @JMSS\Groups({"template_module"})
     */
    private $moduleOrder;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @JMSS\Type("DateTime<'Y-m-d H:i'>")
     * @JMSS\Groups({"template_module"})
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
    private $isActive = '1';

    /**
     * @var string
     *
     * @JMSS\Accessor(getter="getNameBox", setter="setNameBox")
     * @JMSS\Groups({"template_module", "template_has_module"})
     */
    private $nameBox;


    public function __toString() {
        return sprintf('<span class="label label-primary">%s</span> %s', $this->idIncrement, $this->type);
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
     * Set type
     *
     * @param string $type
     *
     * @return TemplateHasModule
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set moduleOrder
     *
     * @param integer $moduleOrder
     *
     * @return TemplateModule
     */
    public function setModuleOrder($moduleOrder)
    {
        $this->moduleOrder = $moduleOrder;

        return $this;
    }

    /**
     * Get moduleOrder
     *
     * @return integer
     */
    public function getModuleOrder()
    {
        return $this->moduleOrder;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return TemplateModule
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
     * @return TemplateModule
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
     * @return TemplateModule
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
        return sprintf('%s', $this->type);
    }

    /**
     * @param string $nameBox
     */
    public function setNameBox($nameBox)
    {
        $this->nameBox = $nameBox;
    }
}
