<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;

/**
 * Course
 *
 * @ORM\Table(name="course")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\CourseRepository")
 */
class Course
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSS\Groups({"course", "course_has_user", "course_has_exam"})
     */
    private $idIncrement;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=45, nullable=true)
     * @JMSS\Groups({"course", "course_has_user"})
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     * @JMSS\Groups({"course", "course_has_user", "course_has_exam"})
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="ciclo", type="integer", length=11, nullable=true)
     * @JMSS\Groups({"course", "course_has_user", "course_has_exam"})
     */
    private $ciclo;
	
	/**
	 * @var string
	 *
	 * @ORM\Column(name="range_start", type="datetime", nullable=true)
	 * @JMSS\Type("DateTime<'H:i'>")
	 * @JMSS\Groups({"course", "course_has_user", "course_has_exam"})
	 */
	private $rangeStart;
	
	/**
	 * @var string
	 *
	 * @ORM\Column(name="range_end", type="datetime", nullable=true)
	 * @JMSS\Type("DateTime<'H:i'>")
	 * @JMSS\Groups({"course", "course_has_user", "course_has_exam"})
	 */
	private $rangeEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     * @JMSS\Type("DateTime<'Y-m-d H:i'>")
     * @JMSS\Groups({"course"})
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
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\User", inversedBy="course")
     * @ORM\JoinTable(name="course_has_user",
     *   joinColumns={
     *     @ORM\JoinColumn(name="course_id", referencedColumnName="id_increment")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *   }
     * )
     * @JMSS\Groups({"course_has_user"})
     */
    private $user;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\Exam", inversedBy="course")
     * @ORM\JoinTable(name="course_has_exam",
     *   joinColumns={
     *     @ORM\JoinColumn(name="course_id", referencedColumnName="id_increment")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="exam_id", referencedColumnName="id_increment")
     *   }
     * )
     * @JMSS\Groups({"course_has_exam"})
     */
    private $exam;

    /**
     * @var string
     *
     * @JMSS\Accessor(getter="getNameBox", setter="setNameBox")
     * @JMSS\Groups({"course_has_user", "course"})
     */
    private $nameBox;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->exam = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set code
     *
     * @param string $code
     *
     * @return Course
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Course
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
     * @return Course
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
     * @return Course
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
     * @return Course
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
     *
     * @return string
     */
    public function getNameBox()
    {
        return sprintf('%s', $this->name);
    }

    /**
     * @param string $nameBox
     */
    public function setNameBox($nameBox)
    {
        $this->nameBox = $nameBox;
    }



    /**
     * Add user
     *
     * @param \CoreBundle\Entity\User $user
     *
     * @return Course
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
     * Add exam
     *
     * @param \CoreBundle\Entity\Exam $exam
     *
     * @return Course
     */
    public function addExam(\CoreBundle\Entity\Exam $exam)
    {
        $this->exam[] = $exam;

        return $this;
    }

    /**
     * Remove exam
     *
     * @param \CoreBundle\Entity\Exam $exam
     */
    public function removeExam(\CoreBundle\Entity\Exam $exam)
    {
        $this->exam->removeElement($exam);
    }

    /**
     * Get exam
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExam()
    {
        return $this->exam;
    }
	
	/**
	 * @return int
	 */
	public function getCiclo()
	{
		return $this->ciclo;
	}
	
	/**
	 * @param int $ciclo
	 */
	public function setCiclo($ciclo)
	{
		$this->ciclo = $ciclo;
	}
	
	/**
	 * @return string
	 */
	public function getRangeStart()
	{
		return $this->rangeStart;
	}
	
	/**
	 * @param string $rangeStart
	 */
	public function setRangeStart($rangeStart)
	{
		$this->rangeStart = $rangeStart;
	}
	
	/**
	 * @return string
	 */
	public function getRangeEnd()
	{
		return $this->rangeEnd;
	}
	
	/**
	 * @param string $rangeEnd
	 */
	public function setRangeEnd($rangeEnd)
	{
		$this->rangeEnd = $rangeEnd;
	}
	
	

}
