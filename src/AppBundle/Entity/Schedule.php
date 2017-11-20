<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Schedule
 *
 * @ORM\Table(name="schedule", indexes={@ORM\Index(name="fk_schedule_user_system1_idx", columns={"user_system_id"}), @ORM\Index(name="fk_schedule_barber1_idx", columns={"barber_id"})})
 * @ORM\Entity
 */
class Schedule
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive;

    /**
     * @var \Barber
     *
     * @ORM\ManyToOne(targetEntity="Barber")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="barber_id", referencedColumnName="id")
     * })
     */
    private $barber;

    /**
     * @var \UserSystem
     *
     * @ORM\ManyToOne(targetEntity="UserSystem")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_system_id", referencedColumnName="id")
     * })
     */
    private $userSystem;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Schedule
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Schedule
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set barber
     *
     * @param \AppBundle\Entity\Barber $barber
     * @return Schedule
     */
    public function setBarber(\AppBundle\Entity\Barber $barber = null)
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
     * Set userSystem
     *
     * @param \AppBundle\Entity\UserSystem $userSystem
     * @return Schedule
     */
    public function setUserSystem(\AppBundle\Entity\UserSystem $userSystem = null)
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
