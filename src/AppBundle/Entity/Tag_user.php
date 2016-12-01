<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag_user
 *
 * @ORM\Table(name="tag_user")
 * @ORM\Entity
 */

class Tag_user
{
	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="id")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     */
    private $userId;

	/**
     * @ORM\Column(type="string", length=100)
     */   
    private $user_tag;


    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Tag_user
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Tag_user
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set userTag
     *
     * @param string $userTag
     *
     * @return Tag_user
     */
    public function setUserTag($userTag)
    {
        $this->user_tag = $userTag;

        return $this;
    }

    /**
     * Get userTag
     *
     * @return string
     */
    public function getUserTag()
    {
        return $this->user_tag;
    }
}
