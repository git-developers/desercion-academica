<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;

/**
 * Exam
 *
 * @ORM\Table(name="exam")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\ExamRepository")
 */
class Exam
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSS\Groups({"exam", "course_has_exam"})
     */
    private $idIncrement;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=45, nullable=true)
     * @JMSS\Groups({"exam"})
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     * @JMSS\Groups({"exam", "course_has_exam"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     * @JMSS\Groups({"exam", "course_has_exam"})
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     * @JMSS\Type("DateTime<'Y-m-d H:i'>")
     * @JMSS\Groups({"course_has_exam"})
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @JMSS\Groups({"exam"})
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
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\Course", mappedBy="exam")
     */
    private $course;

    /**
     * @var string
     *
     * @JMSS\Accessor(getter="getNameBox", setter="setNameBox")
     * @JMSS\Groups({"exam", "course_has_exam"})
     */
    private $nameBox;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->course = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Exam
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
     * @return Exam
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
     * Set description
     *
     * @param string $description
     *
     * @return Exam
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
     * @return Exam
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
     * @return Exam
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
     * @return Exam
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
     * Add course
     *
     * @param \CoreBundle\Entity\Course $course
     *
     * @return Exam
     */
    public function addCourse(\CoreBundle\Entity\Course $course)
    {
        $this->course[] = $course;

        return $this;
    }

    /**
     * Remove course
     *
     * @param \CoreBundle\Entity\Course $course
     */
    public function removeCourse(\CoreBundle\Entity\Course $course)
    {
        $this->course->removeElement($course);
    }

    /**
     * Get course
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCourse()
    {
        return $this->course;
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

}
