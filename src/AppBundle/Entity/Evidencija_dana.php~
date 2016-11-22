<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evidencija_dana
 *
 * @ORM\Table(name="evidencija_dana")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Evidencija_danaRepository")
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
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datum", type="date")
     */
    private $datum;

    /**
     *
     * @ORM\Column(name="done_business_hours", type="float")
     */
    private $done_business_hours;

    


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
}
