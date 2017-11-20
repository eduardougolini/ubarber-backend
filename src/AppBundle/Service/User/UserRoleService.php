<?php

namespace AppBundle\Service\User;

/**
 * Description of UserRoleService
 *
 * @author eduardo - edu.ugolini2@gmail.com
 */
class UserRoleService {
    
    public function getRoleInheritance($role) : array {
        switch($role) {
            case 'USER':
                return ['USER'];
            case 'MANAGER':
                return ['MANAGER', 'USER'];
            case 'ADMIN':
                return ['ADMIN', 'MANAGER', 'USER'];
            default: 
                return [];
        }
    }
    
}
