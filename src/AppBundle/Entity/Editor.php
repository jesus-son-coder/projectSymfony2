<?php
/**
 * Created by PhpStorm.
 * User: rvck2
 * Date: 13/11/2018
 * Time: 13:52
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Editor
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EditorRepository")
 */
class Editor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    protected $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    protected $contenu;

    /**
     * @var string
     *
     * @ORM\Column(name="service", type="string", length=255)
     */
    protected $service;

    /**
     * @var date
     *
     * @ORM\Column(name="datepublication", type="date")
     */
    protected $datePublication;

    /**
     * @var string
     *
     * @ORM\Column(name="lang", type="string", length=255)
     */
    protected $lang;

    /**
     * @var string
     *
     * @ORM\Column(name="publicated", type="string", length=255)
     */
    protected $publicated ;

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
     * Set titre
     *
     * @param string $titre
     * @return Editor
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Editor
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set service
     *
     * @param string $service
     * @return Editor
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return string 
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set datePublication
     *
     * @param \DateTime $datePublication
     * @return Editor
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime 
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set lang
     *
     * @param string $lang
     * @return Editor
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return string 
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set publicated
     *
     * @param string $publicated
     * @return Editor
     */
    public function setPublicated($publicated)
    {
        $this->publicated = $publicated;

        return $this;
    }

    /**
     * Get publicated
     *
     * @return string
     */
    public function getPublicated()
    {
        return $this->publicated;
    }
}
