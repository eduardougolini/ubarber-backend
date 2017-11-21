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
        $service->setIsActive(1);

        
        $this->em->persist($service);
        $this->em->flush();
    }
    
    public function updateBarberService(Service $service, $field, $value) {
        $methodCall = 'set' . ucfirst($field);
        
        
        
        if (property_exists($service, $field)) {
            $service->$methodCall($value);
        } else {
            throw new \Exception("Campo $field desconhecido!", 400);
        }
        
        $this->em->flush();
    }

    public function getBarberServices(Barber $barber) {
        return $this->em->createQuery(
            'SELECT s '
            . 'FROM AppBundle:Barber b '
            . 'JOIN AppBundle:Service s '
                . 'WITH s.barber = b '
                    . 'AND s.isActive = 1 '
            . 'WHERE b = :barber'
        )->setParameter('barber', $barber)
        ->getArrayResult();
    }
    
}
