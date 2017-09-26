<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;

/**
 * TemplateHasModule
 *
 * @ORM\Table(name="template_has_module", indexes={
 *     @ORM\Index(name="FK_2CD747CAFC2B591", columns={"module_id"}),
 *     @ORM\Index(name="FK_2CD747C5DA0FB8", columns={"template_id"}),
 *     @ORM\Index(name="FK_2CD747C952C56F9", columns={"template_has_module_id"})
 * })
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\TemplateHasModuleRepository")
 */

class TemplateHasModule
{

    const HTML_INDEX = 'index.html';
    const HTML_BLOG = 'blog.html';
    const HTML_BLOG_POST = 'blog_post.html';

    const CHOICES_TEMPLATE_HTML = [
        self::HTML_INDEX => self::HTML_INDEX,
        self::HTML_BLOG => self::HTML_BLOG,
        self::HTML_BLOG_POST => self::HTML_BLOG_POST,
    ];


    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSS\Groups({"template_has_module", "template_frontend", "template_paragraph"})
     */
    private $idIncrement;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     * @JMSS\Groups({"template_has_module", "template_frontend"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     * @JMSS\Groups({"template_has_module", "template_frontend"})
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="template_name", type="string", length=100, nullable=true)
     */
    private $templateName;

    /**
     * @var string
     *
     * @ORM\Column(name="settings", type="text", nullable=true)
     * @JMSS\Groups({"template_has_module"})
     */
    private $settings;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_parent", type="boolean", nullable=true)
     */
    private $isParent;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive = '1';

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
     * @var \CoreBundle\Entity\TemplateHasModule
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\TemplateHasModule")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="template_has_module_id", referencedColumnName="id_increment")
     * })
     */
    private $templateHasModule;

    /**
     * @var \CoreBundle\Entity\TemplateModule
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\TemplateModule")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="module_id", referencedColumnName="id_increment")
     * })
     * @JMSS\Groups({"template_has_module", "template_frontend"})
     */
    private $module;

    /**
     * @var \CoreBundle\Entity\Template
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Template")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="template_id", referencedColumnName="id_increment")
     * })
     * @JMSS\Groups({"template_has_module"})
     */
    private $template;


    public function __toString() {
        return sprintf('(%s) %s', $this->idIncrement, $this->name);
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
     * @return TemplateHasModule
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
     * @return TemplateHasModule
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
     * @return TemplateHasModule
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
     * @return TemplateHasModule
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
     * @return TemplateHasModule
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
     * Set template
     *
     * @param \CoreBundle\Entity\Template $template
     *
     * @return TemplateHasModule
     */
    public function setTemplate(\CoreBundle\Entity\Template $template = null)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Get template
     *
     * @return \CoreBundle\Entity\Template
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set module
     *
     * @param \CoreBundle\Entity\TemplateModule $module
     *
     * @return TemplateHasModule
     */
    public function setModule(\CoreBundle\Entity\TemplateModule $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \CoreBundle\Entity\TemplateModule
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return TemplateHasModule
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set settings
     *
     * @param string $settings
     *
     * @return TemplateHasModule
     */
    public function setSettings($settings)
    {
        $this->settings = serialize($settings);

        return $this;
    }

    /**
     * Get settings
     *
     * @return string
     */
    public function getSettings()
    {
        return unserialize($this->settings);
    }

    /**
     * Set templateName
     *
     * @param string $templateName
     *
     * @return TemplateHasModule
     */
    public function setTemplateName($templateName)
    {
        $this->templateName = $templateName;

        return $this;
    }

    /**
     * Get templateName
     *
     * @return string
     */
    public function getTemplateName()
    {
        return $this->templateName;
    }

    /**
     * Set isParent
     *
     * @param boolean $isParent
     *
     * @return TemplateHasModule
     */
    public function setIsParent($isParent)
    {
        $this->isParent = $isParent;

        return $this;
    }

    /**
     * Get isParent
     *
     * @return boolean
     */
    public function getIsParent()
    {
        return $this->isParent;
    }

}
