<?php

namespace keyManager\keyBundle\Twig\Extension;

use Symfony\Bridge\Doctrine\RegistryInterface;

class querykeytableExtension extends \Twig_Extension
{
    protected $doctrine;

    private $em;
    private $conn;

    public function __construct(\Doctrine\ORM\EntityManager $em) {
        $this->em = $em;
        $this->conn = $em->getConnection();
    }
//    /**
//     * @param RegistryInterface $doctrine
//     */
//    public function __construct(RegistryInterface $doctrine) {
//        $this->doctrine = $doctrine;
//    }

    public function getFunctions()
    {
        return array(
            'keys' => new \Twig_Function_Method($this, 'getKeys'),
        );
    }

    public function getKeys($id)
    {
        //$query = $this->doctrine->getRepository('keyManagerkeyBundle:KeyNew')->createQuery("select");
        //$keys = $this->doctrine->getRepository('keyManagerkeyBundle:KeyNew')->findBy(array('tpenew'=>$id));
        //$keys = $this->doctrine->getRepository('keyManagerkeyBundle:KeyNew')->findBytpenew($id);
        //$keys = $this->doctrine->getRepository('keyManagerkeyBundle:KeyNew')->selectRowWithtpenew($id);
        $sql = "SELECT * FROM KeyNew WHERE tpenew_id = $id";
        //return $keys;
        return $this->conn->fetchAll($sql);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'querykeytable_extension';
    }
}