<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Barber;
use AppBundle\Entity\UserSystem;
use AppBundle\Entity\Schedule;
use AppBundle\Annotation\ValidateUser;

/**
 * Description of ScheduleController
 * @Route("/schedulement")
 * @author eduardo - edu.ugolini2@gmail.com
 */
class ScheduleController extends Controller {

    /**
     * @Route("/new/{barber}/{dateTimestamp}")
     * @Method({"POST"})
     * @ParamConverter("barber", class="AppBundle:Barber")
     */
    public function addNewSchedulement(Barber $barber, string $dateTimestamp) {
        $userSystem = $this->getDoctrine()->getManager()->getRepository(UserSystem::class)->find($this->getUser()->getId());
        $date = new \DateTime();
        $date->setTimestamp($dateTimestamp);
        
        $schedule = $this->get('barber_schedule_service')->addNewSchedulement($barber, $userSystem, $date);
        
        return new JsonResponse([
            'id' => $schedule->getId()
        ]);
    }
    
    /**
     * @Route("/update/{scheduleId}/{status}")
     * @Method({"POST"})
     */
    public function updateScheduleStatus($scheduleId, $status) {
        $this->get('barber_schedule_service')->updateSchedulementStatus($scheduleId, $status);
        
        return new JsonResponse();
    }
    
    /**
     * @Route("/get/barber/{barberId}")
     * @ValidateUser("MANAGER")
     * @Method({"GET"})
     */
    public function getBarberSchedulements($barberId) {
        $schedulements = $this->get('barber_schedule_service')->getSchedulements('Barber', $barberId);
        
        return new JsonResponse($schedulements);
    }
    
    /**
     * @Route("/get/user")
     * @Method({"GET"})
     */
    public function getUserSchedulements() {
        $userId = $this->getUser()->getId();
        
        $schedulements = $this->get('barber_schedule_service')->getSchedulements('UserSystem', $userId);
        
        return new JsonResponse($schedulements);
    }
    
}
