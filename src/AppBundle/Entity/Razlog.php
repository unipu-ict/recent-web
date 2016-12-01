<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Evidencija", mappedBy="razlogId")
     */
    protected $id;

	/**
     * @ORM\Column(type="string", length=100)
     */   
    private $razlog;


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
}
