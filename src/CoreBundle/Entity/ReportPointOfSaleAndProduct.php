<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReportPointOfSaleAndProduct
 *
 * @ORM\Table(name="report_point_of_sale_and_product",
 *     indexes={
 *          @ORM\Index(name="FK_72D879C3BBB3B046", columns={"point_of_sale_has_product_id"})
 *      }
 * )
 * @ORM\Entity
 */
class ReportPointOfSaleAndProduct
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
     * @var \DateTime
     *
     * @ORM\Column(name="time_delivery", type="datetime", nullable=true)
     */
    private $timeDelivery;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock_out", type="integer", nullable=false)
     */
    private $stockOut;

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
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private $isActive = '1';

    /**
     * @var \CoreBundle\Entity\PointOfSaleHasProduct
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\PointOfSaleHasProduct")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="point_of_sale_has_product_id", referencedColumnName="id_increment")
     * })
     */
    private $pointOfSaleHasProduct;



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
     * Set timeDelivery
     *
     * @param \DateTime $timeDelivery
     *
     * @return ReportPointOfSaleAndProduct
     */
    public function setTimeDelivery($timeDelivery)
    {
        $this->timeDelivery = $timeDelivery;

        return $this;
    }

    /**
     * Get timeDelivery
     *
     * @return \DateTime
     */
    public function getTimeDelivery()
    {
        return $this->timeDelivery;
    }

    /**
     * Set stockOut
     *
     * @param integer $stockOut
     *
     * @return ReportPointOfSaleAndProduct
     */
    public function setStockOut($stockOut)
    {
        $this->stockOut = $stockOut;

        return $this;
    }

    /**
     * Get stockOut
     *
     * @return integer
     */
    public function getStockOut()
    {
        return $this->stockOut;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ReportPointOfSaleAndProduct
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
     * @return ReportPointOfSaleAndProduct
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
     * @return ReportPointOfSaleAndProduct
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
     * Set pointOfSaleHasProduct
     *
     * @param \CoreBundle\Entity\PointOfSaleHasProduct $pointOfSaleHasProduct
     *
     * @return ReportPointOfSaleAndProduct
     */
    public function setPointOfSaleHasProduct(\CoreBundle\Entity\PointOfSaleHasProduct $pointOfSaleHasProduct = null)
    {
        $this->pointOfSaleHasProduct = $pointOfSaleHasProduct;

        return $this;
    }

    /**
     * Get pointOfSaleHasProduct
     *
     * @return \CoreBundle\Entity\PointOfSaleHasProduct
     */
    public function getPointOfSaleHasProduct()
    {
        return $this->pointOfSaleHasProduct;
    }
}
