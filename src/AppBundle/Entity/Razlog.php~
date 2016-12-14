<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Razlog
 *
 * @ORM\Table(name="razlog")
 * @ORM\Entity
 */

class Razlog
{
	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    protected $id;

	/**
     * @ORM\Column(type="string", length=100)
     */   
    private $razlog;

    /**
     * @ORM\OneToMany(targetEntity="Evidencija", mappedBy="razlogId")
     */
    protected $razlozi;

    public function __construct()
    {
        $this->razlozi = new ArrayCollection();

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
     * Set razlog
     *
     * @param string $razlog
     *
     * @return Razlog
     */
    public function setRazlog($razlog)
    {
        $this->razlog = $razlog;

        return $this;
    }

    /**
     * Get razlog
     *
     * @return string
     */
    public function getRazlog()
    {
        return $this->razlog;
    }

    /**
     * Add razlozi
     *
     * @param \AppBundle\Entity\Evidencija $razlozi
     *
     * @return Razlog
     */
    public function addRazlozi(\AppBundle\Entity\Evidencija $razlozi)
    {
        $this->razlozi[] = $razlozi;

        return $this;
    }

    /**
     * Remove razlozi
     *
     * @param \AppBundle\Entity\Evidencija $razlozi
     */
    public function removeRazlozi(\AppBundle\Entity\Evidencija $razlozi)
    {
        $this->razlozi->removeElement($razlozi);
    }

    /**
     * Get razlozi
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRazlozi()
    {
        return $this->razlozi;
    }
}
