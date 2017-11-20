<?php

namespace AppBundle\Listener;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\Common\Annotations\AnnotationReader;
use AppBundle\Entity\UserSystem;
use AppBundle\Entity\User;
use AppBundle\Annotation\ValidateUser;

/**
 * Description of ControllerListener
 *
 * @author eduardo - edu.ugolini2@gmail.com
 */
class ControllerListener {
    private $em, $tokenStorage;
    
    public function __construct(EntityManager $em, TokenStorage $tokenStorage) {
        $this->em = $em;
        $this->tokenStorage = $tokenStorage;
    }
    
    public function onKernelController(FilterControllerEvent $event) {
        $controller = $event->getController();
        
        if (is_null($token = $this->tokenStorage->getToken())) {
            return;
        }

        $annotations = $this->getControllerAnnotations($controller);
        
        foreach ($annotations as $validUserAnnotation) {
            if (! $validUserAnnotation instanceof ValidateUser) {
                continue;
            }
        
            $userEntity = $token->getUser();

            if (! $userEntity instanceof User) {
                throw new \Exception('Usuário deve estar logado para acessar esta página', 403);
            }

            $user = $this->em->getRepository(UserSystem::class)->find($userEntity->getId());
            
            $userSystemRoles = $this->em->createQuery(
                'SELECT ur.name '
                . 'FROM AppBundle:UserSystem us '
                . 'JOIN AppBundle:BarberHasUserSystem bhus '
                    . 'WITH bhus.userSystem = us '
                . 'JOIN AppBundle:UserRole ur '
                    . 'WITH ur = bhus.userRole '
                . 'WHERE us = :userSystemId'
            )->setParameter('userSystemId', $user)
            ->getResult();
            
            if (!in_array($validUserAnnotation->getNeededRole(), $userSystemRoles[0])) {
                throw new \Exception('Usuário sem acesso a página requerida', 403);
            }
        }
    }
    
    private function getControllerAnnotations($controller) {
        if (is_array($controller)) {
            $className = $controller[0];
            $parameter = $controller[1];
            $reflectionMethod = new \ReflectionMethod($className, $parameter);
        } elseif (is_object($controller) && is_callable($controller, '__invoke')) {
            $reflectionMethod = new \ReflectionMethod($controller, '__invoke');
        } else {
            $reflectionMethod = new \ReflectionFunction($controller);
        }
        
        $annotationReader = new AnnotationReader();
        
        return $annotationReader->getMethodAnnotations($reflectionMethod);
    }
    
}
