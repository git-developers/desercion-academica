<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;

/**
 * CategoryHasProduct
 *
 * @ORM\Table(name="category_has_product",
 *     indexes={
 *          @ORM\Index(name="FK_3202E1D4584665A", columns={"product_id"}),
 *          @ORM\Index(name="FK_3202E1D12469DE2", columns={"category_id"})
 *      }
 * )
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\CategoryHasProductRepository")
 */
class CategoryHasProduct
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSS\SerializedName("id_associative")
     * @JMSS\Groups({"category_has_product"})
     */
    private $idIncrement;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock", type="integer", nullable=true)
     */
    private $stock;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var \CoreBundle\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id_increment")
     * })
     */
    private $category;

    /**
     * @var \CoreBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id_increment")
     * })
     * @JMSS\Groups({"category_has_product"})
     */
    private $product;



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
     * Set stock
     *
     * @param integer $stock
     *
     * @return CategoryHasProduct
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return CategoryHasProduct
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
     * @return CategoryHasProduct
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
     * Set category
     *
     * @param \CoreBundle\Entity\Category $category
     *
     * @return CategoryHasProduct
     */
    public function setCategory(\CoreBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \CoreBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set product
     *
     * @param \CoreBundle\Entity\Product $product
     *
     * @return CategoryHasProduct
     */
    public function setProduct(\CoreBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \CoreBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}
