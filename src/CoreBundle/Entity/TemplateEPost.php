<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;

/**
 * TemplateEPost
 *
 * @ORM\Table(name="template_e_post",
 *     indexes={
 *          @ORM\Index(name="FK_239EDD33952C56F9", columns={"template_has_module_id"}),
 *          @ORM\Index(name="FK_239EDD3330CDB79B", columns={"template_e_category_id"})
 *      }
 * )
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\TemplateEPostRepository")
 */
class TemplateEPost
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSS\Groups({"template_e_post"})
     */
    private $idIncrement;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=45, nullable=false)
     * @JMSS\Groups({"template_e_post"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=true)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="excerpt", type="text", length=65535, nullable=true)
     * @JMSS\Groups({"template_e_post"})
     */
    private $excerpt;

    /**
     * @var string
     *
     * @ORM\Column(name="keyword", type="text", length=65535, nullable=true)
     */
    private $keyword;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @JMSS\Type("DateTime<'Y-m-d H:i'>")
     * @JMSS\Groups({"template_e_post"})
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\TemplateEPostTag", inversedBy="templateEPost")
     * @ORM\JoinTable(name="template_e_post_has_template_e_post_tag",
     *   joinColumns={
     *     @ORM\JoinColumn(name="template_e_post_id", referencedColumnName="id_increment")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="template_e_post_tag_id", referencedColumnName="id_increment")
     *   }
     * )
     */
    private $templateEPostTag;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\TemplateEPostTag", mappedBy="templateEPostIncrement")
     */
    private $templateEPostTagIncrement;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\TemplateEPostTag", mappedBy="templatePost")
     */
    private $templatePostTag;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->templateEPostTag = new \Doctrine\Common\Collections\ArrayCollection();
        $this->templateEPostTagIncrement = new \Doctrine\Common\Collections\ArrayCollection();
        $this->templatePostTag = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return TemplateEPost
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return TemplateEPost
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
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
     * Set keyword
     *
     * @param string $keyword
     *
     * @return TemplateEPost
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return TemplateEPost
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
     * @return TemplateEPost
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
     * @return TemplateEPost
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
     * @return TemplateEPost
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
     * @return TemplateEPost
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

    /**
     * Add templateEPostTag
     *
     * @param \CoreBundle\Entity\TemplateEPostTag $templateEPostTag
     *
     * @return TemplateEPost
     */
    public function addTemplateEPostTag(\CoreBundle\Entity\TemplateEPostTag $templateEPostTag)
    {
        $this->templateEPostTag[] = $templateEPostTag;

        return $this;
    }

    /**
     * Remove templateEPostTag
     *
     * @param \CoreBundle\Entity\TemplateEPostTag $templateEPostTag
     */
    public function removeTemplateEPostTag(\CoreBundle\Entity\TemplateEPostTag $templateEPostTag)
    {
        $this->templateEPostTag->removeElement($templateEPostTag);
    }

    /**
     * Get templateEPostTag
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTemplateEPostTag()
    {
        return $this->templateEPostTag;
    }

    /**
     * Add templateEPostTagIncrement
     *
     * @param \CoreBundle\Entity\TemplateEPostTag $templateEPostTagIncrement
     *
     * @return TemplateEPost
     */
    public function addTemplateEPostTagIncrement(\CoreBundle\Entity\TemplateEPostTag $templateEPostTagIncrement)
    {
        $this->templateEPostTagIncrement[] = $templateEPostTagIncrement;

        return $this;
    }

    /**
     * Remove templateEPostTagIncrement
     *
     * @param \CoreBundle\Entity\TemplateEPostTag $templateEPostTagIncrement
     */
    public function removeTemplateEPostTagIncrement(\CoreBundle\Entity\TemplateEPostTag $templateEPostTagIncrement)
    {
        $this->templateEPostTagIncrement->removeElement($templateEPostTagIncrement);
    }

    /**
     * Get templateEPostTagIncrement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTemplateEPostTagIncrement()
    {
        return $this->templateEPostTagIncrement;
    }

    /**
     * Add templatePostTag
     *
     * @param \CoreBundle\Entity\TemplateEPostTag $templatePostTag
     *
     * @return TemplateEPost
     */
    public function addTemplatePostTag(\CoreBundle\Entity\TemplateEPostTag $templatePostTag)
    {
        $this->templatePostTag[] = $templatePostTag;

        return $this;
    }

    /**
     * Remove templatePostTag
     *
     * @param \CoreBundle\Entity\TemplateEPostTag $templatePostTag
     */
    public function removeTemplatePostTag(\CoreBundle\Entity\TemplateEPostTag $templatePostTag)
    {
        $this->templatePostTag->removeElement($templatePostTag);
    }

    /**
     * Get templatePostTag
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTemplatePostTag()
    {
        return $this->templatePostTag;
    }
}
