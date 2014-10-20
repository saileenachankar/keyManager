<?php

namespace keyManager\keyBundle\Controller;

use keyManager\keyBundle\Entity\Role;
use keyManager\keyBundle\Entity\User;
use keyManager\keyBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;

class homePageController extends Controller
{
    public function indexAction()
    {
        return $this->render('keyManagerkeyBundle:homePage:index.html.twig');
    }

    public function loginAction(Request $request)
    {
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContextInterface::AUTHENTICATION_ERROR
            );
        } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);

        return $this->render(
            'keyManagerkeyBundle:homePage:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }

    public function signupAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(new UserType(), $user);
        $form->handleRequest($request);
        if($form->isValid()){
            $role = new Role();
            $formData = $form->getData();

            $user->setUsername($form->get('username')->getData());
            $user->setSalt(md5(uniqid()));
            $encoder = $this->container
                ->get('security.encoder_factory')
                ->getEncoder($user)
            ;
            $role->setRole('ROLE_USER');
            $user->setPassword($encoder->encodePassword($form->get('password')->getData(), $user->getSalt()));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl("login"));

        }
        return $this->render('keyManagerkeyBundle:homePage:signup.html.twig',array(
                'form'=> $form->createView(),
            ));

    }


}
