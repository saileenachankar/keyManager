<?php

namespace keyManager\keyBundle\Controller;

use keyManager\keyBundle\Entity\Role;
use keyManager\keyBundle\Entity\User;
use keyManager\keyBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;

class historiquePageController extends Controller
{
    public function historiqueProfileAction()
    {
        return $this->render('keyManagerkeyBundle:historiquePage:historiqueProfile.html.twig');
    }
}
  