<?php

namespace keyManager\keyBundle\Controller;

use keyManager\keyBundle\Entity\ClientNew;
use keyManager\keyBundle\Form\ClientNewType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class clientPageController extends Controller
{
    public function clientProfileAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $clients = $em->getRepository('keyManagerkeyBundle:ClientNew')->getAllClients();
        $post = Request::createFromGlobals();
        if ($post->request->has('valider'))
        {
            $clientname = $post->request->get('rechercherClient');

            $clients = $em->getRepository('keyManagerkeyBundle:ClientNew')->getSingleClient($clientname);
        }

        return $this->render('keyManagerkeyBundle:clientPage:clientProfile.html.twig', array('clients' => $clients));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public  function addClientAction(Request $request)
    {
        $error = '';
        $em = $this->getDoctrine()->getManager();
        $clientnew = new clientNew();
        $post = Request::createFromGlobals();
        if ($post->request->has('valider'))
        {
            $clientname = $post->request->get('add_client');
            $client = $em->getRepository('keyManagerkeyBundle:ClientNew')->findOneByclientCompany($clientname);
            if($client)
            {
                $error = 'yes';
                return $this->render('keyManagerkeyBundle:clientPage:addClient.html.twig', array('error' => $error));
            }
            else
            {
                $clientnew->setClientCompany($clientname);
                $em->persist($clientnew);
                $em->flush();
                return $this->redirect($this->generateUrl("ClientProfile_homePage"));
            }
        }

        return $this->render('keyManagerkeyBundle:clientPage:addClient.html.twig', array('error' => $error));
    }

    public function searchClientAction($id)
    {
        $em = $this->getDoctrine();
        $client = $em->getRepository('keyManagerkeyBundle:ClientNew')->find($id);
       // $tpe = $em->getRepository('keyManagerkeyBundle:tpenew')->findByclientname($id);
        $tpes = $em->getRepository('keyManagerkeyBundle:tpenew')->findBy(array('clientNew'=>$id));
       // $key = $em->getRepository('keyManagerkeyBundle:KeyNew')->findOneBy(array('tpenew'=>$tpes->getid()));

        return $this->render('keyManagerkeyBundle:clientPage:searchClient.html.twig', array('client'=>$client, 'tpes'=>$tpes));
    }

    public function updateClientAction($id, Request $request)
    {
        $error = '';
        $clientnew = new ClientNew();
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository('keyManagerkeyBundle:ClientNew')->find($id);
        $form = $this->createForm(new ClientNewType(), $clientnew);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $clientcompany = $form->get('clientCompany')->getData();
            $clientcompanycheck = $em->getRepository('keyManagerkeyBundle:ClientNew')->findOneByclientCompany($clientcompany);

            if($clientcompanycheck)
            {
                $error = 'yes';
                return $this->render('keyManagerkeyBundle:clientPage:updateClient.html.twig', array('form' => $form->createView(), "client"=>$client,'error' => $error));
            }
            else
            {
                $client->setClientCompany($clientcompany);
                $em->flush();
                return $this->redirect($this->generateUrl("ClientProfile_homePage"));
            }

        }

        return $this->render('keyManagerkeyBundle:clientPage:updateClient.html.twig', array('form' => $form->createView(), "client"=>$client, 'error' => $error));
    }
}
  