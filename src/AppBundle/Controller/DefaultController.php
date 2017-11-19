<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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
     * @Route("/json")
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
