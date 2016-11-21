<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag_user
 *
 * @ORM\Table(name="tag_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Tag_userRepository")
 */

class Tag_user
{
	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    protected $id;

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
