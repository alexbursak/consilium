<?php

namespace ConsiliumBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="activity_type")
 */
class ActivityType
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="ConsiliumBundle\Entity\SportActivity", mappedBy="type")
     */
    private $sportActivities;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string")
     */
    private $note;

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
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSportActivitiesByType($type)
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