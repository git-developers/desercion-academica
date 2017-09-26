<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMSS;

/**
 * TemplateEParagraph
 *
 * @ORM\Table(name="template_paragraph",
 *     indexes={
 *          @ORM\Index(name="FK_B480EED4952C56F9", columns={"template_has_module_id"})
 *      }
 * )
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\TemplateEParagraphRepository")
 */
class TemplateEParagraph
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSS\Groups({"template_paragraph"})
     */
    private $idIncrement;

    /**
     * @var string
     *
     * @ORM\Column(name="paragraph", type="text", nullable=true)
     * @JMSS\Groups({"template_paragraph"})
     */
    private $paragraph;

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
     * @var \CoreBundle\Entity\TemplateHasModule
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\TemplateHasModule")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="template_has_module_id", referencedColumnName="id_increment")
     * })
     */
    private $templateHasModule;



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
     * Set paragraph
     *
     * @param string $paragraph
     *
     * @return TemplateEParagraph
     */
    public function setParagraph($paragraph)
    {
        $this->paragraph = $paragraph;

        return $this;
    }

    /**
     * Get paragraph
     *
     * @return string
     */
    public function getParagraph()
    {
        return $this->paragraph;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return TemplateEParagraph
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
     * @return TemplateEParagraph
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
     * @return TemplateEParagraph
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
     * @return TemplateEParagraph
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

}
