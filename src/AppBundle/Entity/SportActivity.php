<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Day", inversedBy="sportActivities")
     * @ORM\JoinColumn(name="day", referencedColumnName="id")
     */
    private $day;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="sets", type="string")
     */
    private $sets;

    /**
     * @var int
     *
     * @ORM\Column(name="reps", type="integer")
     */
    private $reps;

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
     * @return int
     */
    public function getDay()
    {
        return $this->id;
    }

    /**
     * @param \AppBundle\Entity\Day $day
     *
     * @return $this
     */
    public function setDay(Day $day)
    {
        $this->day = $day;

        return $this;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getSets()
    {
        return $this->sets;
    }

    /**
     * @param $sets
     *
     * @return $this
     */
    public function setSets($sets)
    {
        $this->sets = $sets;

        return $this;
    }

    /**
     * @return string
     */
    public function getReps()
    {
        return $this->reps;
    }

    /**
     * @param $reps
     *
     * @return $this
     */
    public function setReps($reps)
    {
        $this->reps = $reps;

        return $this;
    }

    /**
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param $weight
     *
     * @return $this
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }
}