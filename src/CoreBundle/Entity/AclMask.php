<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSS;

/**
 * AclMask
 *
 */
class AclMask
{

    const MASK_VIEW = 1;           // 1 << 0
    const MASK_CREATE = 2;         // 1 << 1
    const MASK_EDIT = 4;           // 1 << 2
    const MASK_DELETE = 8;         // 1 << 3
    const MASK_UNDELETE = 16;      // 1 << 4
    const MASK_OPERATOR = 32;      // 1 << 5
    const MASK_MASTER = 64;        // 1 << 6
    const MASK_OWNER = 128;        // 1 << 7
    const MASK_IDDQD = 1073741823; // 1 << 0 | 1 << 1 | ... | 1 << 30

    /**
     * @var integer
     *
     */
    private $entry;

    /**
     * @var boolean
     *
     */
    private $view;

    /**
     * @var boolean
     *
     */
    private $create;

    /**
     * @var boolean
     *
     */
    private $edit;

    /**
     * @var boolean
     *
     */
    private $delete;

    /**
     * @var boolean
     *
     */
    private $undelete;

    /**
     * @var boolean
     *
     */
    private $operator;

    /**
     * @var boolean
     *
     */
    private $master;

    /**
     * @var boolean
     *
     */
    private $owner;

    /**
     * @return int
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * @param int $entry
     */
    public function setEntry($entry)
    {
        $this->entry = $entry;
    }

    /**
     * @return boolean
     */
    public function isView()
    {
        return $this->view;
    }

    /**
     * @param boolean $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }

    /**
     * @return boolean
     */
    public function isCreate()
    {
        return $this->create;
    }

    /**
     * @param boolean $create
     */
    public function setCreate($create)
    {
        $this->create = $create;
    }

    /**
     * @return boolean
     */
    public function isEdit()
    {
        return $this->edit;
    }

    /**
     * @param boolean $edit
     */
    public function setEdit($edit)
    {
        $this->edit = $edit;
    }

    /**
     * @return boolean
     */
    public function isDelete()
    {
        return $this->delete;
    }

    /**
     * @param boolean $delete
     */
    public function setDelete($delete)
    {
        $this->delete = $delete;
    }

    /**
     * @return boolean
     */
    public function isUndelete()
    {
        return $this->undelete;
    }

    /**
     * @param boolean $undelete
     */
    public function setUndelete($undelete)
    {
        $this->undelete = $undelete;
    }

    /**
     * @return boolean
     */
    public function isOperator()
    {
        return $this->operator;
    }

    /**
     * @param boolean $operator
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }

    /**
     * @return boolean
     */
    public function isMaster()
    {
        return $this->master;
    }

    /**
     * @param boolean $master
     */
    public function setMaster($master)
    {
        $this->master = $master;
    }

    /**
     * @return boolean
     */
    public function isOwner()
    {
        return $this->owner;
    }

    /**
     * @param boolean $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }


}
