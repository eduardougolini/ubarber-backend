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
    
    public function createNewBarber($name, $cnpj, $city, $state, $zip, $street, $district, $number, $complement) : int {
        $address = $this->addressService->createNewAddress($city, $state, $zip, $street, $district, $number, $complement);
        
        $barber = new Barber();
        $barber->setName($name);
        $barber->setCnpj($cnpj);
        $barber->setAddress($address);
        
        $this->em->persist($barber);
        $this->em->flush();
        
        return $barber->getId();
    }
    
    public function editBarber(Barber $barber, $field, $value) {
        $methodCall = 'set' . ucfirst($field);
        
        if (property_exists($barber, $field)) {
            $barber->$methodCall($value);
        } else {
            $address = $barber->getAddress();
            $address->$methodCall($value);
        }
        
        $this->em->flush();
    }
    
    public function getRegisteredBarbers($name) {
        return $this->em->createQuery(
                    'SELECT b.id, b.name '
                    . 'FROM AppBundle:Barber b '
                    . 'WHERE b.name = :name'
                )
                ->setParameter('name',$name)
                ->getArrayResult();
    }
    
}
