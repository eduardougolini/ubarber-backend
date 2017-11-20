<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Barber;
use AppBundle\Entity\UserSystem;
use AppBundle\Entity\Schedule;

/**
 * Description of BarberServicesController
 *
 * @author eduardo - edu.ugolini2@gmail.com
 * @Route("/barber/services")
 */
class BarberServicesController extends Controller {
    
    /**
     * @Method({"POST"})
     * @Route("/add/{barber}")
     * @ParamConverter("barber", class="AppBundle:Barber")
     */
    public function addServiceToBarber(Request $request, Barber $barber) {
        $serviceName = $request->get('serviceName');
        
        $this->get('barber_services_service')->addServiceToBarber($barber, $serviceName);
        
        return new JsonResponse();
    }
    
    /**
     * @Method({"GET"})
     * @Route("/get/{barber}")
     * @ParamConverter("barber", class="AppBundle:Barber")
     */
    public function getBarberServices(Barber $barber) {        
        $services = $this->get('barber_services_service')->getBarberServices($barber);
        
        return new JsonResponse($services);
    }
    
}
