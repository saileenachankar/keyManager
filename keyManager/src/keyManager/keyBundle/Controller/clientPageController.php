<?php

namespace keyManager\keyBundle\Controller;

use keyManager\keyBundle\Entity\ClientNew;
use keyManager\keyBundle\Entity\historicnew;
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

    public function searchClientAction($id, Request $request)
    {
        $em = $this->getDoctrine();
        $client = $em->getRepository('keyManagerkeyBundle:ClientNew')->find($id);
       // $tpe = $em->getRepository('keyManagerkeyBundle:tpenew')->findByclientname($id);
        $tpes = $em->getRepository('keyManagerkeyBundle:tpenew')->findBy(array('clientNew'=>$id));
       // $key = $em->getRepository('keyManagerkeyBundle:KeyNew')->findOneBy(array('tpenew'=>$tpes->getid()));
        $post = Request::createFromGlobals();
        if ($post->request->has('valid'))
        {
            $keys = $this->getDoctrine()->getManager()->getRepository('keyManagerkeyBundle:KeyNew')->findAll();
            foreach($keys as $nonactive) {
            $nonactive->setKeyValid(0);
            $this->getDoctrine()->getManager()->persist($nonactive);
            $this->getDoctrine()->getManager()->flush();
            }

            $checkboxchecked = $post->request->get('checkbox');
            if($checkboxchecked) {
                foreach ($checkboxchecked as $checked) {
                    $key = $this->getDoctrine()->getManager()->getRepository('keyManagerkeyBundle:KeyNew')->find(
                        $checked
                    );
                    $key->setKeyValid(1);
                    $this->getDoctrine()->getManager()->persist($key);
                    $this->getDoctrine()->getManager()->flush();
                }
            }
        }

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
            $data = $form->getData();
            //$clientcompany = $form->get('clientCompany')->getData();
            $clientcompany = $data->getClientCompany();
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

    public function DeleteClientAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $todeleteclient = $em->getRepository('keyManagerkeyBundle:ClientNew')->find($id);
        $post = Request::createFromGlobals();
        if($post->request->has('valider'))
        {
            $tpes = $em->getRepository('keyManagerkeyBundle:tpenew')->findBy(array('clientNew'=>$id));
            if($tpes)
            {
                foreach($tpes as $tpe)
                {
                    $key = $em->getRepository('keyManagerkeyBundle:KeyNew')->findOneBytpenew($tpe->getId());
                    if($key)
                    {
                        $historic = new historicnew();
                        $historic->setKeyID($key->getId());
                        $historic->setKeyStrtDate($key->getStartDate());
                        $historic->setKeyEndDate($key->getEndDate());
                        $historic->setKeyName($key->getKeyName());
                        $historic->setKeyIdTpe($key->getTpenew()->getId());
                        $em->persist($historic);
                        $em->flush();
                        $keyID = $em->getRepository('keyManagerkeyBundle:KeyNew')->findOneBy(array('tpenew'=>$tpe->getId()));
                        $em->remove($keyID);
                        $em->flush();
                    }
                    $em->remove($tpe);
                    $em->flush();
                }
            }
            $client = $em->getRepository('keyManagerkeyBundle:ClientNew')->find($id);
            $em->remove($client);
            $em->flush();
            return $this->redirect($this->generateUrl('ClientProfile_homePage'));
        }

        return $this->render('keyManagerkeyBundle:clientPage:deleteClient.html.twig', array('todeleteclient'=>$todeleteclient));
    }
}
  