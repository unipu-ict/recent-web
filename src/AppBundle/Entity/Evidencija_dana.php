<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evidencija_dana
 *
 * @ORM\Table(name="evidencija_dana")
 * @ORM\Entity
 */
class Evidencija_dana
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="korisnici_dan")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     */
    private $userId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datum", type="date")
     */
    private $datum;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vrijeme_dolaska", type="time")
     */
    private $vrijeme_dolaska;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vrijeme_odlaska", type="time")
     */
    private $vrijeme_odlaska;

    /**
     *
     * @ORM\Column(name="done_business_hours", type="float")
     */
    private $done_business_hours;

    /**
     * @ORM\ManyToOne(targetEntity="Neprisustvo", inversedBy="not_here")
     * @ORM\JoinColumn(name="not_workingId", referencedColumnName="id")
     *
     */
    private $not_workingId;


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
     * @return Evidencija_dana
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
     * Set datum
     *
     * @param \DateTime $datum
     *
     * @return Evidencija_dana
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;

        return $this;
    }

    /**
     * Get datum
     *
     * @return \DateTime
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * Set vrijemeDolaska
     *
     * @param \DateTime $vrijemeDolaska
     *
     * @return Evidencija_dana
     */
    public function setVrijemeDolaska($vrijemeDolaska)
    {
        $this->vrijeme_dolaska = $vrijemeDolaska;

        return $this;
    }

    /**
     * Get vrijemeDolaska
     *
     * @return \DateTime
     */
    public function getVrijemeDolaska()
    {
        return $this->vrijeme_dolaska;
    }

    /**
     * Set vrijemeOdlaska
     *
     * @param \DateTime $vrijemeOdlaska
     *
     * @return Evidencija_dana
     */
    public function setVrijemeOdlaska($vrijemeOdlaska)
    {
        $this->vrijeme_odlaska = $vrijemeOdlaska;

        return $this;
    }

    /**
     * Get vrijemeOdlaska
     *
     * @return \DateTime
     */
    public function getVrijemeOdlaska()
    {
        return $this->vrijeme_odlaska;
    }

    /**
     * Set doneBusinessHours
     *
     * @param float $doneBusinessHours
     *
     * @return Evidencija_dana
     */
    public function setDoneBusinessHours($doneBusinessHours)
    {
        $this->done_business_hours = $doneBusinessHours;

        return $this;
    }

    /**
     * Get doneBusinessHours
     *
     * @return float
     */
    public function getDoneBusinessHours()
    {
        return $this->done_business_hours;
    }

    /**
     * Set notWorkingId
     *
     * @param \AppBundle\Entity\Neprisustvo $notWorkingId
     *
     * @return Evidencija_dana
     */
    public function setNotWorkingId(\AppBundle\Entity\Neprisustvo $notWorkingId = null)
    {
        $this->not_workingId = $notWorkingId;

        return $this;
    }

    /**
     * Get notWorkingId
     *
     * @return \AppBundle\Entity\Neprisustvo
     */
    public function getNotWorkingId()
    {
        return $this->not_workingId;
    }
}
