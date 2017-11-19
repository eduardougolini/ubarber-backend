<?php

namespace AppBundle\Service\Address;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Address;

/**
 * Description of AddressService
 *
 * @author eduardo - edu.ugolini2@gmail.com
 */
class AddressService {
    
    private $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function createNewAddress($city, $state, $zip, $street, $district, $number, $complement) : Address {
        $address = new Address();
        $address->setCity($city);
        $address->setDistrict($district);
        $address->setNumber($number);
        $address->setComplement($complement);
        $address->setState($state);
        $address->setStreet($street);
        $address->setZip($zip);
        
        $this->em->persist($address);
        
        return $address;
    }
    
}
