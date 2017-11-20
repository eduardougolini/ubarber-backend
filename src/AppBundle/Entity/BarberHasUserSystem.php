<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BarberHasUserSystem
 *
 * @ORM\Table(name="barber_has_user_system", indexes={@ORM\Index(name="fk_barber_has_user_system_user_system1_idx", columns={"user_system_id"}), @ORM\Index(name="fk_barber_has_user_system_barber1_idx", columns={"barber_id"}), @ORM\Index(name="fk_barber_has_user_system_user_role1_idx", columns={"user_role_id"})})
 * @ORM\Entity
 */
class BarberHasUserSystem
{
    /**
     * @var \Barber
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Barber")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="barber_id", referencedColumnName="id")
     * })
     */
    private $barber;

    /**
     * @var \UserRole
     *
     * @ORM\ManyToOne(targetEntity="UserRole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_role_id", referencedColumnName="id")
     * })
     */
    private $userRole;

    /**
     * @var \UserSystem
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="UserSystem")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_system_id", referencedColumnName="id")
     * })
     */
    private $userSystem;



    /**
     * Set barber
     *
     * @param \AppBundle\Entity\Barber $barber
     * @return BarberHasUserSystem
     */
    public function setBarber(\AppBundle\Entity\Barber $barber)
    {
        $this->barber = $barber;

        return $this;
    }

    /**
     * Get barber
     *
     * @return \AppBundle\Entity\Barber 
     */
    public function getBarber()
    {
        return $this->barber;
    }

    /**
     * Set userRole
     *
     * @param \AppBundle\Entity\UserRole $userRole
     * @return BarberHasUserSystem
     */
    public function setUserRole(\AppBundle\Entity\UserRole $userRole = null)
    {
        $this->userRole = $userRole;

        return $this;
    }

    /**
     * Get userRole
     *
     * @return \AppBundle\Entity\UserRole 
     */
    public function getUserRole()
    {
        return $this->userRole;
    }

    /**
     * Set userSystem
     *
     * @param \AppBundle\Entity\UserSystem $userSystem
     * @return BarberHasUserSystem
     */
    public function setUserSystem(\AppBundle\Entity\UserSystem $userSystem)
    {
        $this->userSystem = $userSystem;

        return $this;
    }

    /**
     * Get userSystem
     *
     * @return \AppBundle\Entity\UserSystem 
     */
    public function getUserSystem()
    {
        return $this->userSystem;
    }
}
