<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Files
 *
 * @ORM\Table(name="files", uniqueConstraints={@ORM\UniqueConstraint(name="id_file_UNIQUE", columns={"id_file"}), @ORM\UniqueConstraint(name="unique_id_UNIQUE", columns={"unique_id"}) })
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\FilesRepository")
 * @UniqueEntity(
 *     fields={"unique_id"},
 *     message="El campo unique fue utilizado anteriormente"
 * )
 */
class Files
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSS\Groups({"file_data"})
     */
    private $idIncrement;

    /**
     * @var string
     *
     * @ORM\Column(name="id_file", type="string", length=255, nullable=false)
     * @JMSS\Groups({"file_data"})
     */
    private $idFile;

    /**
     * @var string
     *
     * @ORM\Column(name="unique_id", type="string", length=20, nullable=false)
     * @JMSS\Groups({"file_data"})
     */
    private $uniqueId;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=false)
     * @JMSS\Groups({"file_data"})
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="icon_link", type="string", length=255, nullable=false)
     * @JMSS\Groups({"file_data"})
     */
    private $iconLink;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @JMSS\Type("DateTime<'H:i Y-m-d'>")
     * @JMSS\Groups({"file_data"})
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
    private $isActive;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", length=65535, nullable=false)
     * @JMSS\Groups({"file_data"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="string", length=255, nullable=false)
     */
    private $size;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\User", mappedBy="files")
     */
    private $user;

    /**
     * @var \CoreBundle\Entity\FileMimeType
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\FileMimeType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_mime_type", referencedColumnName="id_increment")
     * })
     * @JMSS\Groups({"file_data"})
     */
    private $idMimeType;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set idFile
     *
     * @param string $idFile
     *
     * @return Files
     */
    public function setIdFile($idFile)
    {
        $this->idFile = $idFile;

        return $this;
    }

    /**
     * Get idFile
     *
     * @return string
     */
    public function getIdFile()
    {
        return $this->idFile;
    }

    /**
     * @return string
     */
    public function getUniqueId()
    {
        return $this->uniqueId;
    }

    /**
     * @param string $uniqueId
     */
    public function setUniqueId($uniqueId)
    {
        $this->uniqueId = $uniqueId;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Files
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getIconLink()
    {
        return $this->iconLink;
    }

    /**
     * @param string $iconLink
     */
    public function setIconLink($iconLink)
    {
        $this->iconLink = $iconLink;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Files
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
     * @return Files
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
     * @return Files
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
     * Set name
     *
     * @param string $name
     *
     * @return Files
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
     * Set size
     *
     * @param string $size
     *
     * @return Files
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
     * Add user
     *
     * @param \CoreBundle\Entity\User $user
     *
     * @return Files
     */
    public function addUser(\CoreBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \CoreBundle\Entity\User $user
     */
    public function removeUser(\CoreBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set idMimeType
     *
     * @param \CoreBundle\Entity\FileMimeType $idMimeType
     *
     * @return Files
     */
    public function setIdMimeType(\CoreBundle\Entity\FileMimeType $idMimeType = null)
    {
        $this->idMimeType = $idMimeType;

        return $this;
    }

    /**
     * Get idMimeType
     *
     * @return \CoreBundle\Entity\FileMimeType
     */
    public function getIdMimeType()
    {
        return $this->idMimeType;
    }

}
