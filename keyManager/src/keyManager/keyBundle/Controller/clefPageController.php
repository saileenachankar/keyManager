<?php

namespace keyManager\keyBundle\Controller;

use keyManager\keyBundle\Entity\Role;
use keyManager\keyBundle\Entity\User;
use keyManager\keyBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;

class clefPageController extends Controller
{
    public function clefProfileAction()
    {
        return $this->render('keyManagerkeyBundle:clefPage:clefProfile.html.twig');
    }
}
  