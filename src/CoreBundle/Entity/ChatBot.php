<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;

/**
 * ChatBot
 *
 * @ORM\Table(name="chat_bot")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\ChatBotRepository")
 */
class ChatBot
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSS\Groups({"chatbot"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     * @JMSS\Groups({"chatbot"})
     */
    private $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     * @JMSS\Groups({"chatbot"})
     */
    private $description;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     * @JMSS\Type("DateTime<'Y-m-d H:i'>")
     * @JMSS\Groups({"chatbot"})
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
    private $isActive = 1;
	
	/**
	 * @var \Doctrine\Common\Collections\Collection
	 *
	 * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\User", inversedBy="chatbot")
	 * @ORM\JoinTable(name="chatbot_has_user",
	 *   joinColumns={
	 *     @ORM\JoinColumn(name="chatbot_id", referencedColumnName="id")
	 *   },
	 *   inverseJoinColumns={
	 *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 *   }
	 * )
	 */
	private $user;
	

    /**
     * Constructor
     */
    public function __construct()
    {
	    $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }
	
	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}
	
	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}
	
	/**
	 * @param string $description
	 */
	public function setDescription($description)
	{
		$this->description = $description;
	}
	
	/**
	 * @return \DateTime
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}
	
	/**
	 * @param \DateTime $createdAt
	 */
	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;
	}
	
	/**
	 * @return \DateTime
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}
	
	/**
	 * @param \DateTime $updatedAt
	 */
	public function setUpdatedAt($updatedAt)
	{
		$this->updatedAt = $updatedAt;
	}
	
	/**
	 * @return bool
	 */
	public function isActive()
	{
		return $this->isActive;
	}
	
	/**
	 * @param bool $isActive
	 */
	public function setIsActive($isActive)
	{
		$this->isActive = $isActive;
	}
	
	/**
	 * Add user
	 *
	 * @param \CoreBundle\Entity\User $user
	 *
	 * @return ChatBot
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

}
