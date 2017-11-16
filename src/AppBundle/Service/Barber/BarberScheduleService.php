<?php

namespace AppBundle\Service\Barber;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Schedule;
use AppBundle\Entity\Barber;
use AppBundle\Entity\UserSystem;

/**
 * Description of BarberScheduleService
 *
 * @author eduardo - edu.ugolini2@gmail.com
 */
class BarberScheduleService {
    
    private $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function addNewSchedulement(Barber $barber, UserSystem $userSystem, \DateTime $dateTime) : Schedule {
        $schedule = new Schedule();
        
        $schedule->setBarber($barber);
        $schedule->setUserSystem($userSystem);
        $schedule->setDate($dateTime);
        
        $this->em->persist($schedule);
        $this->em->flush();
        
        return $schedule;
    }
    
    public function getSchedulements(string $filter, $entityId) : array {
        if (! [$filter] == array_intersect([$filter], ['Barber', 'UserSystem'])) {
            throw new \Exception("Filtro $filter desconhecido", 400);
        }
        
        $schedulements = $this->em->createQuery(
            'SELECT s '
            . 'FROM :filter f '
            . 'JOIN AppBundle:Schedulement s '
                . 'WITH s.:filter = f '
            . 'WHERE f = :entityId'
        )->setParameter('filter', $filter)
        ->setParameter('entityId', $entityId)
        ->getArrayResult();
        
        return $schedulements;
    }
    
}
