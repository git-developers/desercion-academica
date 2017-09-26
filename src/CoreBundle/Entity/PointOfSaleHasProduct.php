<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;

/**
 * PointOfSaleHasProduct
 *
 * @ORM\Table(name="point_of_sale_has_product",
 *      indexes={
 *          @ORM\Index(name="FK_63AAC6454584665A", columns={"product_id"}),
 *          @ORM\Index(name="FK_63AAC6456B7E9A73", columns={"point_of_sale_id"})
 *      }
 * )
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\PointOfSaleHasProductRepository")
 */
class PointOfSaleHasProduct
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSS\SerializedName("id_associative")
     * @JMSS\Groups({"pointofsales_has_product"})
     */
    private $idIncrement;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock", type="integer", nullable=true)
     */
    private $stock;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock_min", type="integer", nullable=true)
     */
    private $stockMin;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock_max", type="integer", nullable=true)
     */
    private $stockMax;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var \CoreBundle\Entity\PointOfSale
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\PointOfSale")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="point_of_sale_id", referencedColumnName="id_increment")
     * })
     */
    private $pointOfSale;

    /**
     * @var \CoreBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id_increment")
     * })
     * @JMSS\Groups({"pointofsales_has_product"})
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
     * @return PointOfSaleHasProduct
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
     * Set stockMin
     *
     * @param integer $stockMin
     *
     * @return PointOfSaleHasProduct
     */
    public function setStockMin($stockMin)
    {
        $this->stockMin = $stockMin;

        return $this;
    }

    /**
     * Get stockMin
     *
     * @return integer
     */
    public function getStockMin()
    {
        return $this->stockMin;
    }

    /**
     * Set stockMax
     *
     * @param integer $stockMax
     *
     * @return PointOfSaleHasProduct
     */
    public function setStockMax($stockMax)
    {
        $this->stockMax = $stockMax;

        return $this;
    }

    /**
     * Get stockMax
     *
     * @return integer
     */
    public function getStockMax()
    {
        return $this->stockMax;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return PointOfSaleHasProduct
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return PointOfSaleHasProduct
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
     * @return PointOfSaleHasProduct
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
     * Set pointOfSale
     *
     * @param \CoreBundle\Entity\PointOfSale $pointOfSale
     *
     * @return PointOfSaleHasProduct
     */
    public function setPointOfSale(\CoreBundle\Entity\PointOfSale $pointOfSale = null)
    {
        $this->pointOfSale = $pointOfSale;

        return $this;
    }

    /**
     * Get pointOfSale
     *
     * @return \CoreBundle\Entity\PointOfSale
     */
    public function getPointOfSale()
    {
        return $this->pointOfSale;
    }

    /**
     * Set product
     *
     * @param \CoreBundle\Entity\Product $product
     *
     * @return PointOfSaleHasProduct
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
