<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class DayRepository extends EntityRepository
{
    public function findDayByDate($date)
    {
        $date = \DateTime::createFromFormat('d-m-Y', $date);

        $day = $this->getEntityManager()
            ->createQuery('SELECT p
                           FROM AppBundle:Day p 
                           WHERE p.date LIKE :date')
            ->setParameter('date', $date->format('Y-m-d') . '%')
            ->getResult();

        return $day[0];
    }
}