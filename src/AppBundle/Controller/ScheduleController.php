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
 * Description of ScheduleController
 * @Route("/schedulement")
 * @author eduardo - edu.ugolini2@gmail.com
 */
class ScheduleController extends Controller {

    /**
     * @Route("/new/{barber}/{userSystem}/{dateTimestamp}")
     * @ParamConverter("barber", class="AppBundle:Barber")
     * @ParamConverter("userSystem", class="AppBundle:UserSystem")
     */
    public function addNewSchedulement(Barber $barber, UserSystem $userSystem, string $dateTimestamp) {
        $date = new \DateTime();
        $date->setTimestamp($dateTimestamp);
        
        $schedule = $this->get('barber_schedule_service')->addNewSchedulement($barber, $userSystem, $date);
        
        return new JsonResponse([
            'id' => $schedule->getId()
        ]);
    }
    
    /**
     * @Route("/get/barber/{barberId}")
     */
    public function getBarberSchedulements($barberId) {
        $schedulements = $this->get('barber_schedule_service')->getSchedulements('Barber', $barberId);
        
        return new JsonResponse($schedulements);
    }
    
}
