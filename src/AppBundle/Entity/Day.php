<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="days")
 */
class Day
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="name", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string")
     */
    private $note;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SportActivity", mappedBy="day")
     */
    private $sportActivities;

    public function __construct()
    {
        $this->sportActivities = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param $date
     *
     * @return $this
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param $note
     *
     * @return $this
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @param SportActivity $sportActivity
     *
     * @return $this
     */
    public function addSportActivity(SportActivity $sportActivity)
    {
        $this->sportActivities[] = $sportActivity;

        return $this;
    }
    /**
     * @param SportActivity $sportActivity
     */
    public function removeSportActivity(SportActivity $sportActivity)
    {
        $this->sportActivities->removeElement($sportActivity);
    }
    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSportActivities()
    {
        return $this->sportActivities->getValues();
    }
}