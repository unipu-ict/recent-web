<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Evidencija
 *
 * @ORM\Table(name="evidencija")
 * @ORM\Entity
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
    /**
     * @var int
     *
     * @ORM\Column(name="razlog_id", type="integer")
     */
    private $razlogId;
    /**
     * @var int
     *
     * @ORM\Column(name="uredaj_id", type="integer")
     */
    private $uredajId;


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
     * Set userId
     *
     * @param integer $userId
     *
     * @return Evidencija
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }
    /**
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
        return $this;
    }
    /**
     * Get dateTime
     *
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Set razlogId
     *
     * @param integer $razlogId
     *
     * @return Evidencija
     */
    public function setRazlogId($razlogId)
    {
        $this->razlogId = $razlogId;

        return $this;
    }

    /**
     * Get razlogId
     *
     * @return integer
     */
    public function getRazlogId()
    {
        return $this->razlogId;
    }

    /**
     * Set uredajId
     *
     * @param integer $uredajId
     *
     * @return Evidencija
     */
    public function setUredajId($uredajId)
    {
        $this->uredajId = $uredajId;

        return $this;
    }

    /**
     * Get uredajId
     *
     * @return integer
     */
    public function getUredajId()
    {
        return $this->uredajId;
    }
}
