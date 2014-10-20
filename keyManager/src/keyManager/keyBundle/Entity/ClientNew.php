<?php

namespace keyManager\keyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClientNew
 */
class ClientNew
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $clientCompany;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $tpenews;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tpenews = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set clientCompany
     *
     * @param string $clientCompany
     * @return ClientNew
     */
    public function setClientCompany($clientCompany)
    {
        $this->clientCompany = $clientCompany;

        return $this;
    }

    /**
     * Get clientCompany
     *
     * @return string 
     */
    public function getClientCompany()
    {
        return $this->clientCompany;
    }

    /**
     * Add tpenews
     *
     * @param \keyManager\keyBundle\Entity\tpenew $tpenews
     * @return ClientNew
     */
    public function addTpenews(\keyManager\keyBundle\Entity\tpenew $tpenews)
    {
        $this->tpenews[] = $tpenews;

        return $this;
    }

    /**
     * Remove tpenews
     *
     * @param \keyManager\keyBundle\Entity\tpenew $tpenews
     */
    public function removeTpenews(\keyManager\keyBundle\Entity\tpenew $tpenews)
    {
        $this->tpenews->removeElement($tpenews);
    }

    /**
     * Get tpenews
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTpenews()
    {
        return $this->tpenews;
    }
}
