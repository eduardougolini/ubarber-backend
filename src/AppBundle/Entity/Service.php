<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service")
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Barber", mappedBy="service")
     */
    private $barber;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->barber = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * Add barber
     *
     * @param \AppBundle\Entity\Barber $barber
     * @return Service
     */
    public function addBarber(\AppBundle\Entity\Barber $barber)
    {
        $this->barber[] = $barber;

        return $this;
    }

    /**
     * Remove barber
     *
     * @param \AppBundle\Entity\Barber $barber
     */
    public function removeBarber(\AppBundle\Entity\Barber $barber)
    {
        $this->barber->removeElement($barber);
    }

    /**
     * Get barber
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBarber()
    {
        return $this->barber;
    }
}
