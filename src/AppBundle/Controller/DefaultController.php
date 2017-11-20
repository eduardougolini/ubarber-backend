<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use AppBundle\Annotation\ValidateUser;
use AppBundle\Entity\User;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return new BinaryFileResponse('uBarber-frontend/vue/index.html');
    }
    
    /**
     * @Route("/getUserRoles")
     */
    public function getUserRoles() {
        $user = $this->getUser();
        
        if (! $user instanceof User) {
            return new JsonResponse();
        }
        
        $userSystemRoles = $this->getDoctrine()->getManager()->createQuery(
            'SELECT ur.name '
            . 'FROM AppBundle:UserSystem us '
            . 'JOIN AppBundle:BarberHasUserSystem bhus '
                . 'WITH bhus.userSystem = us '
            . 'JOIN AppBundle:UserRole ur '
                . 'WITH ur = bhus.userRole '
            . 'WHERE us = :userSystemId'
        )->setParameter('userSystemId', $user)
        ->getResult();
        
        return new JsonResponse($userSystemRoles);
    }
    
    /**
     * @Route("/json")
     * @validateUser("ADMIN")
     */
    public function returnJson() {
        $return = [
            'O' => 'O',
            'mene' => 'maumau',
            'ficou' => 'é',
            'pistola' => [
                'putasso' => 'gordo',
                'baitolasso' => 'gordo',
                'locasso' => 'gordo',
            ]
        ];
        
        return new JsonResponse($return);
    }
}
