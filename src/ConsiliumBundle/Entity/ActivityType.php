<?php

namespace AppBundle\Entity;

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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SportActivity", mappedBy="type")
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
     * @return null
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