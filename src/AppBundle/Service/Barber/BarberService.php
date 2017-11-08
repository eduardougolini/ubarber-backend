<?php

namespace AppBundle\Service\Barber;

use Doctrine\ORM\EntityManager;
use AppBundle\Service\Address\AddressService;
use AppBundle\Entity\Barber;

/**
 * Description of BarberService
 *
 * @author eduardo - edu.ugolini2@gmail.com
 */
class BarberService {
    
    private $em, $addressService;
    
    public function __construct(EntityManager $em, AddressService $addressService) {
        $this->em = $em;
        $this->addressService = $addressService;
    }
    
    public function createNewBarber($name, $city, $state, $zip, $street, $district, $number) {
        $address = $this->addressService->createNewAddress($city, $state, $zip, $street, $district, $number);
        
        $barber = new Barber();
        $barber->setName($name);
        $barber->setAddress($address);
        
        $this->em->persist($barber);
        $this->em->flush();
        
        return $barber->getId();
    }
    
    public function getRegisteredBarbers() {
        return $this->em->createQuery(
                'SELECT b.id, b.name '
                . 'FROM AppBundle:Barber b')
                ->getArrayResult();
    }
    
}
