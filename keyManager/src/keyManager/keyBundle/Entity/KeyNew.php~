<?php

namespace keyManager\keyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KeyNew
 */
class KeyNew
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $startDate;

    /**
     * @var \DateTime
     */
    private $endDate;

    /**
     * @var string
     */
    private $keyName;

    /**
     * @var boolean
     */
    private $keyValid;

    /**
     * @var \keyManager\keyBundle\Entity\tpenew
     */
    private $tpenew;

//    public function __construct()
//    {
//        $this->tpenew = new \Doctrine\Common\Collections\ArrayCollection();
//    }


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
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return KeyNew
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return KeyNew
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set keyName
     *
     * @param string $keyName
     * @return KeyNew
     */
    public function setKeyName($keyName)
    {
        $this->keyName = $keyName;

        return $this;
    }

    /**
     * Get keyName
     *
     * @return string 
     */
    public function getKeyName()
    {
        return $this->keyName;
    }

    /**
     * Set keyValid
     *
     * @param boolean $keyValid
     * @return KeyNew
     */
    public function setKeyValid($keyValid)
    {
        $this->keyValid = $keyValid;

        return $this;
    }

    /**
     * Get keyValid
     *
     * @return boolean 
     */
    public function getKeyValid()
    {
        return $this->keyValid;
    }

    /**
     * Set tpenew
     *
     * @param \keyManager\keyBundle\Entity\tpenew $tpenew
     * @return KeyNew
     */
    public function setTpenew(\keyManager\keyBundle\Entity\tpenew $tpenew = null)
    {
        $this->tpenew = $tpenew;

        return $this;
    }

    /**
     * Add tpenew
     *
     * @param \keyManager\keyBundle\Entity\tpenew $tpenew
     * @return KeyNew
     */
    public function addTpenew(\keyManager\keyBundle\Entity\tpenew $tpenew)
    {
        $this->tpenew[] = $tpenew;

        return $this;
    }

    /**
     * Remove tpenew
     *
     * @param \keyManager\keyBundle\Entity\tpenew $tpenew
     */
    public function removeTpenew(\keyManager\keyBundle\Entity\tpenew $tpenew)
    {
        $this->tpenew->removeElement($tpenew);
    }


    /**
     * Get tpenew
     *
     * @return \keyManager\keyBundle\Entity\tpenew 
     */
    public function getTpenew()
    {
        return $this->tpenew;
    }

    function __toString() {
        return $this->getKeyName();
    }


}
