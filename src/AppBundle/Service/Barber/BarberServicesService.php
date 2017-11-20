<?php

namespace AppBundle\Service\Barber;

use Doctrine\ORM\EntityManager;
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
    
    public function addServiceToBarber() {
        
    }
    
    public function getBarberServices() {
        
    }
    
}
