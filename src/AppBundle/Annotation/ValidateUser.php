<?php

namespace AppBundle\Annotation;

/**
 * @Annotation
 * 
 * @author eduardo - edu.ugolini2@gmail.com
 */
class ValidateUser {
    private $neededRole = 'USER';
    
    public function __construct($options) {
        if (isset($options['value'])) {
            $this->neededRole = $options['value'];
            unset($options['value']);
        }
    }
    
    public function getNeededRole() {
        return $this->neededRole;
    }
}
