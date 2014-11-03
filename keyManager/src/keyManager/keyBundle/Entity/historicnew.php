<?php

namespace keyManager\keyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * historicnew
 */
class historicnew
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $keyID;

    /**
     * @var \DateTime
     */
    private $keyStrtDate;

    /**
     * @var \DateTime
     */
    private $keyEndDate;

    /**
     * @var string
     */
    private $keyName;

    /**
     * @var integer
     */
    private $keyIdTpe;


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
     * Set keyID
     *
     * @param integer $keyID
     * @return historicnew
     */
    public function setKeyID($keyID)
    {
        $this->keyID = $keyID;

        return $this;
    }

    /**
     * Get keyID
     *
     * @return integer 
     */
    public function getKeyID()
    {
        return $this->keyID;
    }

    /**
     * Set keyStrtDate
     *
     * @param \DateTime $keyStrtDate
     * @return historicnew
     */
    public function setKeyStrtDate($keyStrtDate)
    {
        $this->keyStrtDate = $keyStrtDate;

        return $this;
    }

    /**
     * Get keyStrtDate
     *
     * @return \DateTime 
     */
    public function getKeyStrtDate()
    {
        return $this->keyStrtDate;
    }

    /**
     * Set keyEndDate
     *
     * @param \DateTime $keyEndDate
     * @return historicnew
     */
    public function setKeyEndDate($keyEndDate)
    {
        $this->keyEndDate = $keyEndDate;

        return $this;
    }

    /**
     * Get keyEndDate
     *
     * @return \DateTime 
     */
    public function getKeyEndDate()
    {
        return $this->keyEndDate;
    }

    /**
     * Set keyName
     *
     * @param string $keyName
     * @return historicnew
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
     * Set keyIdTpe
     *
     * @param integer $keyIdTpe
     * @return historicnew
     */
    public function setKeyIdTpe($keyIdTpe)
    {
        $this->keyIdTpe = $keyIdTpe;

        return $this;
    }

    /**
     * Get keyIdTpe
     *
     * @return integer 
     */
    public function getKeyIdTpe()
    {
        return $this->keyIdTpe;
    }
}
