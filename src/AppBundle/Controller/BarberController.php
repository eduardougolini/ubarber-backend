<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        $city = $request->get('city');
        $state = $request->get('state');
        $zip = $request->get('zip');
        $street = $request->get('street');
        $district = $request->get('district');
        $number = $request->get('number');
        
        $barberId = $this->get('barber_service')->createNewBarber(
                $name,
                $city,
                $state,
                $zip,
                $street,
                $district,
                $number
        );
        
        return new JsonResponse($barberId);
    }
    
    /**
     * @Route("/get")
     * @Method({"GET"})
     */
    public function getRegisteredBarbers() {
        $barbers = $this->get('barber_service')->getRegisteredBarbers();
        
        return new JsonResponse($barbers);
    }
    
}
