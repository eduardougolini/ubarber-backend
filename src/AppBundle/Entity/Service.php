<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service", indexes={@ORM\Index(name="fk_service_barber1_idx", columns={"barber_id"})})
 * @ORM\Entity
 */
class Service
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200, nullable=false)
     */
    private $name;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Service
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set barber
     *
     * @param \AppBundle\Entity\Barber $barber
     * @return Service
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
}
