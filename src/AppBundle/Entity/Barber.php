<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Barber
 *
 * @ORM\Table(name="barber", indexes={@ORM\Index(name="fk_barber_barber1_idx", columns={"barber_id"}), @ORM\Index(name="fk_barber_address1_idx", columns={"address_id"})})
 * @ORM\Entity
 */
class Barber
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
     * @var string
     *
     * @ORM\Column(name="cnpj", type="string", length=45, nullable=false)
     */
    private $cnpj;

    /**
     * @var \Address
     *
     * @ORM\ManyToOne(targetEntity="Address")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     * })
     */
    private $address;

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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Service", inversedBy="barber")
     * @ORM\JoinTable(name="barber_has_service",
     *   joinColumns={
     *     @ORM\JoinColumn(name="barber_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     *   }
     * )
     */
    private $service;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->service = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Barber
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
     * Set cnpj
     *
     * @param string $cnpj
     * @return Barber
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    /**
     * Get cnpj
     *
     * @return string 
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * Set address
     *
     * @param \AppBundle\Entity\Address $address
     * @return Barber
     */
    public function setAddress(\AppBundle\Entity\Address $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \AppBundle\Entity\Address 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set barber
     *
     * @param \AppBundle\Entity\Barber $barber
     * @return Barber
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
     * Add service
     *
     * @param \AppBundle\Entity\Service $service
     * @return Barber
     */
    public function addService(\AppBundle\Entity\Service $service)
    {
        $this->service[] = $service;

        return $this;
    }

    /**
     * Remove service
     *
     * @param \AppBundle\Entity\Service $service
     */
    public function removeService(\AppBundle\Entity\Service $service)
    {
        $this->service->removeElement($service);
    }

    /**
     * Get service
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getService()
    {
        return $this->service;
    }
}
