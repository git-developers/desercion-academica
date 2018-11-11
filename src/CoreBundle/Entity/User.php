<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMSS;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Acl\Model\DomainObjectInterface;
use Cocur\Slugify\Slugify;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation\SerializedName;

//use JMS\Serializer\Annotation\Groups;
//use JMS\Serializer\Annotation\VirtualProperty;



/**
 * User
 *
 * @ORM\Table(name="user_tianos",
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(name="email_UNIQUE", columns={"email"}),
 *          @ORM\UniqueConstraint(name="username_UNIQUE", columns={"username"}),
 *          @ORM\UniqueConstraint(name="dni_UNIQUE", columns={"dni"})},
 *     indexes={
 *          @ORM\Index(name="FK_8D93D649CCFA12B8", columns={"profile_id"})
 *      }
 * )
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\UserRepository")
 * @UniqueEntity(
 *     fields={"dni"},
 *     message="El dni fue registrado por otro usuario"
 * )
 * @UniqueEntity(
 *     fields={"email"},
 *     message="El email fue registrado por otro usuario"
 * )
 * @UniqueEntity(
 *     fields={"username"},
 *     message="El username fue registrado por otro usuario"
 * )
 */
class User extends BaseUser // implements UserInterface, DomainObjectInterface, \Serializable
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMSS\Groups({"user", "user_of_group", "course_has_user"})
     */
    protected $id;

    /**
     * @var string
     *
     * @JMSS\Groups({"user", "user_of_group"})
     */
    protected $username;

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="username", type="string", length=45, precision=0, scale=0, nullable=false, unique=false)
//     * @JMSS\Groups({"user", "user_of_group"})
//     */
//    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     * @JMSS\Groups({"user", "user_of_group", "course_has_user"})
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="device_code", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
     */
    private $deviceCode;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = 6,
     *      max = 500,
     *      minMessage = "Su contraseña debe de ser por lo menos de {{ limit }} caracteres",
     *      maxMessage = "Su contraseña no puede ser mayor a {{ limit }} caracteres"
     * )
     * @Assert\NotBlank(message="password no vacio", groups={"registration"})
     */
    protected $password;

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="salt", type="string", length=45, precision=0, scale=0, nullable=true, unique=false)
//     */
//    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=8, precision=0, scale=0, nullable=true, unique=false)
     * @JMSS\Groups({"user"})
     * @Assert\Length(
     *      min = 8,
     *      max = 8,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank(message="user.dni.not_blank", groups={"registration_admin"})
     */
    private $dni;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     * @JMSS\Groups({"user", "user_of_group"})
     * @Assert\Regex(
     *     pattern="/[^a-zA-Z ]+/",
     *     match=false,
     *     message="user.name.regex"
     * )
     * @Assert\NotBlank(message="user.name.not_blank", groups={"registration_admin", "registration"})
     * @JMSS\Groups({"user", "user_of_group", "course_has_user"})
     */
    private $name;

//@Assert\NotBlank(groups={"registration"})

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
     * @SerializedName("lastName")
     * @JMSS\Groups({"user", "user_of_group"})
     * @Assert\Regex(
     *     pattern="/[^a-zA-Z ]+/",
     *     match=false,
     *     message="user.last_name.regex"
     * )
     * @Assert\NotBlank(message="user.last_name.not_blank", groups={"registration_admin"})
     * @JMSS\Groups({"user", "user_of_group", "course_has_user"})
     */
    private $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dob", type="date", precision=0, scale=0, nullable=true, unique=false)
     * @JMSS\Type("DateTime<'Y-m-d'>")
     * @JMSS\Groups({"user"})
     */
    private $dob;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
     */
    private $address;

    /**
     * @var string
     *
     * @Assert\Email(
     *     message = "El email '{{ value }}' no es valido.",
     *     checkMX = false,
     *     groups={"registration"}
     * )
     * @JMSS\Groups({"user", "user_of_group", "course_has_user"})
     */
    protected $email;

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="email", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
//     * @Assert\Email(
//     *     message = "El email '{{ value }}' no es valido.",
//     *     checkMX = false
//     * )
//     * @Assert\NotBlank(message="Te falto agregar el email.")
//     */
//    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=45, precision=0, scale=0, nullable=true, unique=false)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     * @Assert\File(mimeTypes={ "image/jpg", "image/jpeg", "image/png" })
     * @JMSS\Groups({"user"})
     * @Assert\NotBlank(message="user.image.not_blank", groups={"avatar"})
     */
    private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     * @JMSS\Type("DateTime<'Y-m-d H:i'>")
     * @JMSS\Groups({"user"})
     *
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $updatedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $isActive;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_access", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $lastAccess;

    /**
     * @var \CoreBundle\Entity\Profile
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Profile")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profile_id", referencedColumnName="id_increment")
     * })
     * @Assert\NotBlank(message = "user.profile.not_blank", groups={"registration_admin"} )
     */
    private $profile;

    /**
     * @var \CoreBundle\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client_id", referencedColumnName="id_increment")
     * })
     * @JMSS\Groups({"user"})
     */
    private $client; //      * @Assert\NotBlank(message = "user.client.not_blank", groups={"registration_admin"})

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\GroupOfUsers", mappedBy="user")
     */
    private $groupOfUsers;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\Files", inversedBy="user")
     * @ORM\JoinTable(name="user_has_files",
     *   joinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="files_id", referencedColumnName="id_increment", nullable=true, onDelete="CASCADE")
     *   }
     * )
     */
    private $files;


    /**
     * @var string
     *
     * @JMSS\Accessor(getter="getNameBox", setter="setNameBox")
     * @JMSS\Groups({"user", "course_has_user"})
     */
    private $nameBox;

    /**
     * @var boolean
     *
     * @Assert\IsTrue(message="Tiene que aceptar los terminos y condiciones. 333", groups={"registration"})
     */
    private $termsAccepted;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\Course", mappedBy="user")
     * @JMSS\Groups({"user"})
     */
    private $course;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groupOfUsers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->files = new \Doctrine\Common\Collections\ArrayCollection();
        $this->course = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

//    /**
//     * Set username
//     *
//     * @param string $username
//     *
//     * @return User
//     */
//    public function setUsername($username)
//    {
//        $this->username = $username;
//
//        return $this;
//    }
//
//    /**
//     * Get username
//     *
//     * @return string
//     */
//    public function getUsername()
//    {
//        return $this->username;
//    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return User
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
     * Set deviceCode
     *
     * @param string $deviceCode
     *
     * @return User
     */
    public function setDeviceCode($deviceCode)
    {
        $this->deviceCode = $deviceCode;

        return $this;
    }

    /**
     * Get deviceCode
     *
     * @return string
     */
    public function getDeviceCode()
    {
        return $this->deviceCode;
    }

//    /**
//     * Set password
//     *
//     * @param string $password
//     *
//     * @return User
//     */
//    public function setPassword($password)
//    {
//        $this->password = $password;
//
//        return $this;
//    }
//
//    /**
//     * Get password
//     *
//     * @return string
//     */
//    public function getPassword()
//    {
//        return $this->password;
//    }

//    /**
//     * Set salt
//     *
//     * @param string $salt
//     *
//     * @return User
//     */
//    public function setSalt($salt)
//    {
//        $this->salt = $salt;
//
//        return $this;
//    }
//
//    /**
//     * Get salt
//     *
//     * @return string
//     */
//    public function getSalt()
//    {
//        return $this->salt;
//    }

    /**
     * Set dni
     *
     * @param string $dni
     *
     * @return User
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return string
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
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
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set dob
     *
     * @param \DateTime $dob
     *
     * @return User
     */
    public function setDob($dob)
    {
        $this->dob = $dob;

        return $this;
    }

    /**
     * Get dob
     *
     * @return \DateTime
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

//    /**
//     * Set email
//     *
//     * @param string $email
//     *
//     * @return User
//     */
//    public function setEmail($email)
//    {
//        $this->email = $email;
//
//        return $this;
//    }
//
//    /**
//     * Get email
//     *
//     * @return string
//     */
//    public function getEmail()
//    {
//        return $this->email;
//    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return User
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return User
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
     * @return User
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
     * @return User
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
     * Set lastAccess
     *
     * @param \DateTime $lastAccess
     *
     * @return User
     */
    public function setLastAccess($lastAccess)
    {
        $this->lastAccess = $lastAccess;

        return $this;
    }

    /**
     * Get lastAccess
     *
     * @return \DateTime
     */
    public function getLastAccess()
    {
        return $this->lastAccess;
    }

    /**
     * Set profile
     *
     * @param \CoreBundle\Entity\Profile $profile
     *
     * @return User
     */
    public function setProfile(\CoreBundle\Entity\Profile $profile = null)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return \CoreBundle\Entity\Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Set client
     *
     * @param \CoreBundle\Entity\Client $client
     *
     * @return User
     */
    public function setClient(\CoreBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \CoreBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Add groupOfUser
     *
     * @param \CoreBundle\Entity\GroupOfUsers $groupOfUser
     *
     * @return User
     */
    public function addGroupOfUser(\CoreBundle\Entity\GroupOfUsers $groupOfUser)
    {
        $this->groupOfUsers[] = $groupOfUser;

        return $this;
    }

    /**
     * Remove groupOfUser
     *
     * @param \CoreBundle\Entity\GroupOfUsers $groupOfUser
     */
    public function removeGroupOfUser(\CoreBundle\Entity\GroupOfUsers $groupOfUser)
    {
        $this->groupOfUsers->removeElement($groupOfUser);
    }

    /**
     * Get groupOfUsers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroupOfUsers()
    {
        return $this->groupOfUsers;
    }

    /**
     * Add file
     *
     * @param \CoreBundle\Entity\Files $file
     *
     * @return User
     */
    public function addFile(\CoreBundle\Entity\Files $file)
    {
        $this->files[] = $file;

        return $this;
    }

    /**
     * Remove file
     *
     * @param \CoreBundle\Entity\Files $file
     */
    public function removeFile(\CoreBundle\Entity\Files $file)
    {
        $this->files->removeElement($file);
    }

    /**
     * Get files
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFiles()
    {
        return $this->files;
    }


    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles() {
        $roles = [];

        if(is_object($this->getProfile())){
            foreach ($this->getProfile()->getRole() as $key => $role) {
                $roles[] = $role->getSlug();
            }
        }

        $roles[] = 'ROLE_USER';

        return $roles;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getAvatarFileName()
    {
        if(is_object($this->image)){
            return $this->image->getFileName();
        }

        return;
    }

    public function getObjectIdentifier()
    {
        return 'usuario-210'; //$this->username;
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    /**
     *
     * @return string
     */
    public function getNameBox()
    {
        return sprintf('%s %s', $this->name, $this->lastName);
    }

    /**
     * @param string $nameBox
     */
    public function setNameBox($nameBox)
    {
        $this->nameBox = $nameBox;
    }

    /**
     * @return boolean
     */
    public function isTermsAccepted()
    {
        return $this->termsAccepted;
    }

    /**
     * @param boolean $termsAccepted
     */
    public function setTermsAccepted($termsAccepted)
    {
        $this->termsAccepted = $termsAccepted;
    }





    /**
     * Add course
     *
     * @param \CoreBundle\Entity\Course $course
     *
     * @return UserTianos
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


}
