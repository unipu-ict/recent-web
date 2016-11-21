<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evidencija
 *
 * @ORM\Table(name="evidencija")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvidencijaRepository")
 */
class Evidencija
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
<<<<<<< HEAD
     * @var \DateTime
     *
     * @ORM\Column(name="datum", type="datetime")
     */
    private $datum;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;
=======
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_time", type="datetime")
     */
    private $dateTime;
>>>>>>> masimo


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
<<<<<<< HEAD
     * Set datum
     *
     * @param \DateTime $datum
     *
     * @return Evidencija
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;
=======
     * Set userId
     *
     * @param integer $userId
     *
     * @return Evidencija
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
>>>>>>> masimo

        return $this;
    }

    /**
<<<<<<< HEAD
     * Get datum
     *
     * @return \DateTime
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Evidencija
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
=======
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set dateTime
     *
     * @param \DateTime $dateTime
     *
     * @return Evidencija
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;
>>>>>>> masimo

        return $this;
    }

    /**
<<<<<<< HEAD
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
=======
     * Get dateTime
     *
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }
}

>>>>>>> masimo
