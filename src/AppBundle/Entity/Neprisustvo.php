<?php
/**
 * Created by PhpStorm.
 * User: Marino
 * Date: 11.1.2017.
 * Time: 16:51
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Neprisustvo
 *
 * @ORM\Table(name="neprisustvo")
 * @ORM\Entity
 */
class Neprisustvo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $neprisustvo;

    /**
     * @ORM\OneToMany(targetEntity="Evidencija_dana", mappedBy="not_workingId")
     */
    protected $not_here;

    public function __construct()
    {
        $this->not_here = new ArrayCollection();

    }


    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Neprisutnost
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
     * Set neprisustvo
     *
     * @param string $neprisustvo
     *
     * @return Neprisutnost
     */
    public function setNeprisustvo($neprisustvo)
    {
        $this->neprisustvo = $neprisustvo;

        return $this;
    }

    /**
     * Get neprisustvo
     *
     * @return string
     */
    public function getNeprisustvo()
    {
        return $this->neprisustvo;
    }

    /**
     * Add notHere
     *
     * @param \AppBundle\Entity\Evidencija_dana $notHere
     *
     * @return Neprisutnost
     */
    public function addNotHere(\AppBundle\Entity\Evidencija_dana $notHere)
    {
        $this->not_here[] = $notHere;

        return $this;
    }

    /**
     * Remove notHere
     *
     * @param \AppBundle\Entity\Evidencija_dana $notHere
     */
    public function removeNotHere(\AppBundle\Entity\Evidencija_dana $notHere)
    {
        $this->not_here->removeElement($notHere);
    }

    /**
     * Get notHere
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotHere()
    {
        return $this->not_here;
    }
}
