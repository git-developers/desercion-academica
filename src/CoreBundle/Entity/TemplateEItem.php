<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;

/**
 * TemplateEItem
 *
 * @ORM\Table(name="template_e_item", indexes={
 *     @ORM\Index(name="FK_CAD50F73604E1F5B", columns={"template_has_module_id"}),
 *     @ORM\Index(name="FK_CAD50F7318064505", columns={"template_e_category_id"})
 * })
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\TemplateEItemRepository")
 */
class TemplateEItem
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSS\Groups({"template_e_item"})
     */
    private $idIncrement;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     * @JMSS\Groups({"template_e_item"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=true)
     * @JMSS\Groups({"template_e_item"})
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     * @JMSS\Groups({"template_e_item"})
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="excerpt", type="text", length=65535, nullable=true)
     * @JMSS\Groups({"template_e_item"})
     */
    private $excerpt;

    /**
     * @var string
     *
     * @ORM\Column(name="weight", type="decimal", precision=5, scale=2, nullable=true)
     * @JMSS\Groups({"template_e_item"})
     */
    private $weight;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=45, nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="sku", type="string", length=45, nullable=true)
     * @JMSS\Groups({"template_e_item"})
     */
    private $sku;

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="string", length=45, nullable=true)
     * @JMSS\Groups({"template_e_item"})
     */
    private $size;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=45, nullable=true)
     * @JMSS\Groups({"template_e_item"})
     */
    private $color;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @JMSS\Type("DateTime<'Y-m-d H:i'>")
     * @JMSS\Groups({"template_e_item"})
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
     * @var \CoreBundle\Entity\TemplateHasModule
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\TemplateHasModule")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="template_has_module_id", referencedColumnName="id_increment")
     * })
     */
    private $templateHasModule;

    /**
     * @var \CoreBundle\Entity\TemplateECategory
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\TemplateECategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="template_e_category_id", referencedColumnName="id_increment")
     * })
     */
    private $templateECategory;



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
     * @return TemplateEItem
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
     * Set price
     *
     * @param string $price
     *
     * @return TemplateEItem
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return TemplateEItem
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set excerpt
     *
     * @param string $excerpt
     *
     * @return TemplateEPost
     */
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    /**
     * Get excerpt
     *
     * @return string
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * Set weight
     *
     * @param string $weight
     *
     * @return TemplateEItem
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return TemplateEItem
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set sku
     *
     * @param string $sku
     *
     * @return TemplateEItem
     */
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Get sku
     *
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set size
     *
     * @param string $size
     *
     * @return TemplateEItem
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return TemplateEItem
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return TemplateEItem
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
     * @return TemplateEItem
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
     * @return TemplateEItem
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
     * Set templateHasModule
     *
     * @param \CoreBundle\Entity\TemplateHasModule $templateHasModule
     *
     * @return TemplateEItem
     */
    public function setTemplateHasModule(\CoreBundle\Entity\TemplateHasModule $templateHasModule = null)
    {
        $this->templateHasModule = $templateHasModule;

        return $this;
    }

    /**
     * Get templateHasModule
     *
     * @return \CoreBundle\Entity\TemplateHasModule
     */
    public function getTemplateHasModule()
    {
        return $this->templateHasModule;
    }

    /**
     * Set templateECategory
     *
     * @param \CoreBundle\Entity\TemplateECategory $templateECategory
     *
     * @return TemplateEItem
     */
    public function setTemplateECategory(\CoreBundle\Entity\TemplateECategory $templateECategory = null)
    {
        $this->templateECategory = $templateECategory;

        return $this;
    }

    /**
     * Get templateECategory
     *
     * @return \CoreBundle\Entity\TemplateECategory
     */
    public function getTemplateECategory()
    {
        return $this->templateECategory;
    }
}
