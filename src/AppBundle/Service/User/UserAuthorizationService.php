<?php

namespace AppBundle\Service\User;

use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\Exception\AccountNotLinkedException;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthUserProvider;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\SocialLoginId;
use AppBundle\Entity\UserSystem;
use AppBundle\Entity\User;

/**
 * Description of UserAuthorizationService
 *
 * @author eduardo - edu.ugolini2@gmail.com
 */
class UserAuthorizationService extends OAuthUserProvider implements OAuthAwareUserProviderInterface {
    
    private $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function loadUserByOAuthUserResponse(UserResponseInterface $response) {

        $responseData = $response->getResponse();
        $socialNetwork = $response->getResourceOwner()->getName();
        
        $this->validateSocialData($responseData, $socialNetwork);
        
        return $this->loadUserBySocialId($socialNetwork, $responseData);
    }
    
    private function validateSocialData($responseData, $serviceName){
        
        if (isset($responseData['error'])){
            throw new AccountNotLinkedException($responseData['error']['message']);
        }
        
        if ( ! in_array($serviceName, ['google', 'facebook'])){
            throw new \Exception('O serviço ' . $serviceName . ' não está configurado ainda');
        }
        
        if ( ! isset($responseData['name']) || ! isset($responseData['id'])){
            throw new \Exception("Faltando parâmetros");
        }
    }
    
    private function createUserSystemForSocialMediaWithSocialId($socialNetwork, $socialUserData){
        $user = new UserSystem();
        $user->setName($socialUserData['name']);
        $user->setUserImage($socialUserData['picture']);
        $this->em->persist($user);
        
        $socialLoginId = new SocialLoginId();
        $socialLoginId->setSocialNetwork($socialNetwork);
        $socialLoginId->setSocialUserId($socialUserData['id']);
        $socialLoginId->setUserSystem($user);
        
        $this->em->persist($socialLoginId);
        
        $this->em->flush();
        
        return $user;
    }
    
    private function loadUserBySocialId($socialNetwork, $socialUserData){
        
        $socialUser = $this->em->getRepository("AppBundle:SocialLoginId")->findOneBy([
            'socialNetwork' => $socialNetwork,
            'socialUserId'  => $socialUserData['id']
        ]);
        
        if ($socialUser){
            $user = $socialUser->getUserSystem();
            $user->setUserImage($socialUserData['picture']);
            $this->em->flush();
            return $this->createUserInterfaceInstance($user->getId(), $user->getName());
        }
        
        $newUserSystem = $this->createUserSystemForSocialMediaWithSocialId($socialNetwork, $socialUserData);
        return $this->createUserInterfaceInstance($newUserSystem->getId(), $socialUserData['name']);
        
    }
    
    private function createUserInterfaceInstance($userId, $name){
        $user = new User();
        $user->setIsActive(true);
        $user->setName($name);
        $user->setUserId($userId);
        
        return $user;
    }
    
}