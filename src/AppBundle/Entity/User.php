<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     *
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Please enter your surname.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $surname;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Group")
     * @ORM\JoinTable(name="fos_user_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;
    /**
     * @ORM\OneToMany(targetEntity="Evidencija", mappedBy="userId")
     */
    protected $korisnici;

    public function __construct()
    {
        $this->korisnici = new ArrayCollection();
        parent::__construct();
        // your own logic
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Add korisnici
     *
     * @param \AppBundle\Entity\Evidencija $korisnici
     *
     * @return User
     */
    public function addKorisnici(\AppBundle\Entity\Evidencija $korisnici)
    {
        $this->korisnici[] = $korisnici;

        return $this;
    }

    /**
     * Remove korisnici
     *
     * @param \AppBundle\Entity\Evidencija $korisnici
     */
    public function removeKorisnici(\AppBundle\Entity\Evidencija $korisnici)
    {
        $this->korisnici->removeElement($korisnici);
    }

    /**
     * Get korisnici
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKorisnici()
    {
        return $this->korisnici;
    }
}
