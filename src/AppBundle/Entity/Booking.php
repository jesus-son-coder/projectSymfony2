<?php
/**
 * Created by PhpStorm.
 * User: rvck2
 * Date: 04/11/2018
 * Time: 20:19
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Booking
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="client", type="string", length=255)
     * @Assert\Length(max=255)
     */
    private $client;

    /**
     * @var date
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="chambre", type="string", length=255)
     * @Assert\Length(max=255)
     */
    private $chambre;


    /**
     * @var string
     *
     * @ORM\Column(name="payment", type="string", length=255)
     * @Assert\Length(max=255)
     */
    private $moyenpayment;



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
     * Set client
     *
     * @param string $client
     * @return Booking
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return string 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Booking
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
     * Set chambre
     *
     * @param string $chambre
     * @return Booking
     */
    public function setChambre($chambre)
    {
        $this->chambre = $chambre;

        return $this;
    }

    /**
     * Get chambre
     *
     * @return string 
     */
    public function getChambre()
    {
        return $this->chambre;
    }

    /**
     * Set moyenpayment
     *
     * @param string $moyenpayment
     * @return Booking
     */
    public function setMoyenpayment($moyenpayment)
    {
        $this->moyenpayment = $moyenpayment;

        return $this;
    }

    /**
     * Get moyenpayment
     *
     * @return string 
     */
    public function getMoyenpayment()
    {
        return $this->moyenpayment;
    }
}
