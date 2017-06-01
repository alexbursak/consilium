<?php
namespace ConsiliumBundle\Repository;

use Doctrine\ORM\EntityRepository;

class DayRepository extends EntityRepository
{
    /**
     * @param string $date
     *
     * @return string|null
     */
    public function findDayByDate($date)
    {
        $date = \DateTime::createFromFormat('d-m-Y', $date);

        $day = $this->getEntityManager()
            ->createQuery('SELECT d
                           FROM ConsiliumBundle:Day d
                           WHERE d.date = :date')
            ->setParameter('date', $date->format('Y-m-d'))
            ->getResult();

        return empty($day) ? null : $day[0];
    }
}