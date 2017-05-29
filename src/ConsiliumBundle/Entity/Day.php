<?php

namespace ConsiliumBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ConsiliumBundle\Repository\DayRepository")
 * @ORM\Table(name="day")
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
     * @ORM\Column(name="date", type="date", unique=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", nullable=true)
     */
    private $note;

    /**
     * @ORM\OneToMany(targetEntity="ConsiliumBundle\Entity\SportActivity", mappedBy="day")
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
     * @param \DateTime $date
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
     * @param string $note
     *
     * @return $this
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @param \ConsiliumBundle\Entity\SportActivity $sportActivity
     *
     * @return $this
     */
    public function addSportActivity(SportActivity $sportActivity)
    {
        $this->sportActivities[] = $sportActivity;

        return $this;
    }
    /**
     * @param \ConsiliumBundle\Entity\SportActivity $sportActivity
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

    /**
     * @param string $type
     *
     * @return null|\ConsiliumBundle\Entity\SportActivity
     */
    public function getSportActivityByType($type)
    {
        $sportActivities = $this->sportActivities->getValues();
        $sportActivity = null;

        foreach ($sportActivities as $activity){
            if ($activity->getType()->getNote() == $type){
                $sportActivity = $activity;
            }
        }

        return $sportActivity;
    }
}