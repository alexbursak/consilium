<?php

namespace ConsiliumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


/**
 * @ORM\Entity
 * @ORM\Table(name="sport_activity")
 */
class SportActivity
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="ConsiliumBundle\Entity\Day", inversedBy="sportActivities")
     * @ORM\JoinColumn(name="day", referencedColumnName="id")
     */
    private $day;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string")
     */
    private $title;

    /**
     * @var \ConsiliumBundle\Entity\ActivityType
     *
     * @ORM\ManyToOne(targetEntity="ConsiliumBundle\Entity\ActivityType", inversedBy="sportActivities")
     * @ORM\JoinColumn(name="type", referencedColumnName="id")
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="reps", type="integer")
     */
    private $reps;

    /**
     * @var string
     *
     * @ORM\Column(name="sets", type="integer")
     */
    private $sets;

    /**
     * @var float
     *
     * @ORM\Column(name="weight", type="float")
     */
    private $weight;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \ConsiliumBundle\Entity\Day
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param \ConsiliumBundle\Entity\Day $day
     *
     * @return $this
     */
    public function setDay(Day $day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * @return \ConsiliumBundle\Entity\ActivityType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param \ConsiliumBundle\Entity\ActivityType $type
     *
     * @return $this
     */
    public function setType(ActivityType $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return int
     */
    public function getSets()
    {
        return $this->sets;
    }

    /**
     * @param int $sets
     *
     * @return $this
     */
    public function setSets($sets)
    {
        $this->sets = $sets;

        return $this;
    }

    /**
     * @return int
     */
    public function getReps()
    {
        return $this->reps;
    }

    /**
     * @param int $reps
     *
     * @return $this
     */
    public function setReps($reps)
    {
        $this->reps = $reps;

        return $this;
    }

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     *
     * @return $this
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }
}