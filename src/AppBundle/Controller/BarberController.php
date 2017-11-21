<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Annotation\ValidateUser;
use AppBundle\Entity\Barber;

/**
 * Description of BarberController
 *
 * @author eduardo - edu.ugolini2@gmail.com
 * @Route("/barber")
 */
class BarberController extends Controller {
    
    /**
     * @Route("/new")
     * @Method({"POST"})
     * @param Request $request
     */
    public function createNewBarber(Request $request) {
        $name = $request->get('name');
        $cnpj = $request->get('cnpj');
        $city = $request->get('city');
        $state = $request->get('state');
        $zip = $request->get('zip');
        $street = $request->get('street');
        $district = $request->get('district');
        $number = $request->get('number');
        $complement = $request->get('complement');
        
        $barberId = $this->get('barber_service')->createNewBarber(
                $name,
                $cnpj,
                $city,
                $state,
                $zip,
                $street,
                $district,
                $number,
                $complement
        );
        
        return new JsonResponse($barberId);
    }
    
    /**
     * @Route("/edit/{barber}")
     * @ParamConverter("barber", class="AppBundle:Barber")
     */
    public function editRegisteredBarber(Request $request, Barber $barber) {
        $field = $request->get('field');
        $value = $request->get('value');
        
        $this->get('barber_service')->editBarber($barber, $field, $value);
        
        return new JsonResponse();
    }
    
    /**
     * @Route("/get/{id}", requirements={"id": "\d+"})
     * @Method({"GET"})
     */
    public function getRegisteredBarbersById($id) {
        $barbers = $this->get('barber_service')->getRegisteredBarbersById($id);
        return new JsonResponse($barbers);
    }
    
    /**
     * @Route("/get/{name}")
     * @Method({"GET"})
     */
    public function getRegisteredBarbersByName($name) {
        $barbers = $this->get('barber_service')->getRegisteredBarbersByName($name);
        return new JsonResponse($barbers);
    }
    
    /**
     * @ValidateUser("ADMIN")
     * @Route("/getOwnBarber")
     */
    public function getAdminUserBarber() {
        $userSystemId = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        
        $barbers = $em->createQuery(
            'SELECT b.id, b.name, b.cnpj, a.zip, a.street, a.number, a.complement, a.district, a.city, a.state '
                . 'FROM AppBundle:UserSystem us '
                . 'JOIN AppBundle:BarberHasUserSystem bhus '
                    . 'WITH bhus.userSystem = :userSystem '
                . 'JOIN AppBundle:Barber b '
                    . 'WITH b = bhus.barber '
                . 'JOIN AppBundle:Address a '
                    . 'WITH b.address = a '
                . 'WHERE us = :userSystem'
        )->setParameter('userSystem', $userSystemId)
        ->getArrayResult();

        return new JsonResponse($barbers);
    }
}
