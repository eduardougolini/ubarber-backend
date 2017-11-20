<?php

namespace AppBundle\Service\Barber;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Barber;
use AppBundle\Entity\Service;

/**
 * Description of BarberServicesService
 *
 * @author eduardo - edu.ugolini2@gmail.com
 */
class BarberServicesService {
    
    private $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function addServiceToBarber(Barber $barber, $serviceName) {
        $service = new Service();
        
        $service->setName($serviceName);
        $service->setBarber($barber);
        
        $this->em->persist($service);
        $this->em->flush();
    }
    
    public function getBarberServices(Barber $barber) {
        return $this->em->createQuery(
            'SELECT s '
            . 'FROM AppBundle:Barber b '
            . 'JOIN AppBundle:Service s '
                . 'WITH s.barber = b '
            . 'WHERE b = :barber'
        )->setParameter('barber', $barber)
        ->getArrayResult();
    }
    
}
