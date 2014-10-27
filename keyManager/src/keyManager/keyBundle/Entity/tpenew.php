<?php

namespace keyManager\keyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * tpenew
 */
class tpenew
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $tpeNum;

    /**
     * @var \keyManager\keyBundle\Entity\ClientNew
     */
    private $clientNew;


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
     * Set tpeNum
     *
     * @param string $tpeNum
     * @return tpenew
     */
    public function setTpeNum($tpeNum)
    {
        $this->tpeNum = $tpeNum;

        return $this;
    }

    /**
     * Get tpeNum
     *
     * @return string 
     */
    public function getTpeNum()
    {
        return $this->tpeNum;
    }

    /**
     * Set clientNew
     *
     * @param \keyManager\keyBundle\Entity\ClientNew $clientNew
     * @return tpenew
     */
    public function setClientNew(\keyManager\keyBundle\Entity\ClientNew $clientNew = null)
    {
        $this->clientNew = $clientNew;

        return $this;
    }

    /**
     * Get clientNew
     *
     * @return \keyManager\keyBundle\Entity\ClientNew 
     */
    public function getClientNew()
    {
        return $this->clientNew;
    }
    /**
     * @var \keyManager\keyBundle\Entity\p
     */
    private $cascade;


    /**
     * Set cascade
     *
     * @param \keyManager\keyBundle\Entity\p $cascade
     * @return tpenew
     */
    public function setCascade(\keyManager\keyBundle\Entity\p $cascade = null)
    {
        $this->cascade = $cascade;

        return $this;
    }

    /**
     * Get cascade
     *
     * @return \keyManager\keyBundle\Entity\p 
     */
    public function getCascade()
    {
        return $this->cascade;
    }
}
