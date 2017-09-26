<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TemplateEPostTag
 *
 * @ORM\Table(name="template_e_post_tag")
 * @ORM\Entity
 */
class TemplateEPostTag
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

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
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive = '1';

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\TemplateEPost", mappedBy="templateEPostTag")
     */
    private $templateEPost;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\TemplateEPost", inversedBy="templateEPostTagIncrement")
     * @ORM\JoinTable(name="template_e_post_tag_has_template_e_post",
     *   joinColumns={
     *     @ORM\JoinColumn(name="template_e_post_tag_id_increment", referencedColumnName="id_increment")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="template_e_post_id_increment", referencedColumnName="id_increment")
     *   }
     * )
     */
    private $templateEPostIncrement;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\TemplateEPost", inversedBy="templatePostTag")
     * @ORM\JoinTable(name="template_tag_has_template_post",
     *   joinColumns={
     *     @ORM\JoinColumn(name="template_post_tag_id", referencedColumnName="id_increment")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="template_post_id", referencedColumnName="id_increment")
     *   }
     * )
     */
    private $templatePost;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->templateEPost = new \Doctrine\Common\Collections\ArrayCollection();
        $this->templateEPostIncrement = new \Doctrine\Common\Collections\ArrayCollection();
        $this->templatePost = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return TemplateEPostTag
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
     * @return TemplateEPostTag
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
     * @return TemplateEPostTag
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
     * @return TemplateEPostTag
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
     * Add templateEPost
     *
     * @param \CoreBundle\Entity\TemplateEPost $templateEPost
     *
     * @return TemplateEPostTag
     */
    public function addTemplateEPost(\CoreBundle\Entity\TemplateEPost $templateEPost)
    {
        $this->templateEPost[] = $templateEPost;

        return $this;
    }

    /**
     * Remove templateEPost
     *
     * @param \CoreBundle\Entity\TemplateEPost $templateEPost
     */
    public function removeTemplateEPost(\CoreBundle\Entity\TemplateEPost $templateEPost)
    {
        $this->templateEPost->removeElement($templateEPost);
    }

    /**
     * Get templateEPost
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTemplateEPost()
    {
        return $this->templateEPost;
    }

    /**
     * Add templateEPostIncrement
     *
     * @param \CoreBundle\Entity\TemplateEPost $templateEPostIncrement
     *
     * @return TemplateEPostTag
     */
    public function addTemplateEPostIncrement(\CoreBundle\Entity\TemplateEPost $templateEPostIncrement)
    {
        $this->templateEPostIncrement[] = $templateEPostIncrement;

        return $this;
    }

    /**
     * Remove templateEPostIncrement
     *
     * @param \CoreBundle\Entity\TemplateEPost $templateEPostIncrement
     */
    public function removeTemplateEPostIncrement(\CoreBundle\Entity\TemplateEPost $templateEPostIncrement)
    {
        $this->templateEPostIncrement->removeElement($templateEPostIncrement);
    }

    /**
     * Get templateEPostIncrement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTemplateEPostIncrement()
    {
        return $this->templateEPostIncrement;
    }

    /**
     * Add templatePost
     *
     * @param \CoreBundle\Entity\TemplateEPost $templatePost
     *
     * @return TemplateEPostTag
     */
    public function addTemplatePost(\CoreBundle\Entity\TemplateEPost $templatePost)
    {
        $this->templatePost[] = $templatePost;

        return $this;
    }

    /**
     * Remove templatePost
     *
     * @param \CoreBundle\Entity\TemplateEPost $templatePost
     */
    public function removeTemplatePost(\CoreBundle\Entity\TemplateEPost $templatePost)
    {
        $this->templatePost->removeElement($templatePost);
    }

    /**
     * Get templatePost
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTemplatePost()
    {
        return $this->templatePost;
    }
}
