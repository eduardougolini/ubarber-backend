<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
     * @Route("/get/{name}")
     * @Method({"GET"})
     */
    public function getRegisteredBarbers($name) {
        $barbers = $this->get('barber_service')->getRegisteredBarbers($name);
        return new JsonResponse($barbers);
    }
    
}
