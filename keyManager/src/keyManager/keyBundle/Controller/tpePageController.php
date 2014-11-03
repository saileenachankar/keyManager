<?php

namespace keyManager\keyBundle\Controller;

use keyManager\keyBundle\Entity\ClientNew;
use keyManager\keyBundle\Entity\tpenew;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class tpePageController extends Controller
{
    public function tpeProfileAction()
    {
        return $this->render('keyManagerkeyBundle:tpePage:tpeProfile.html.twig');
    }

    public  function addTpeAction(Request $request, $id)
    {
        $error = '';
        $selectedclient = '';
        $em = $this->getDoctrine()->getManager();
        $tpe = new tpenew();
        if($id)
        {
            $selectedclient = $em->getRepository('keyManagerkeyBundle:ClientNew')->find($id);
            $clientnames = $em->getRepository('keyManagerkeyBundle:ClientNew')->getexceptselected($id);
        }
        else
        {
            $clientnames = $em->getRepository('keyManagerkeyBundle:ClientNew')->findAll();
        }
        //$clientnames = $em->getRepository('keyManagerkeyBundle:ClientNew')->findAll();
        $post = Request::createFromGlobals();
        if($post->request->has('valider'))
        {
            $tpenum = $post->request->get('numTPE');
            $clientname = $post->request->get('client_company');
            $tpenumcheck = $em->getRepository('keyManagerkeyBundle:tpenew')->findOneBytpeNum($tpenum);
            if($tpenumcheck)
            {
                $error = 'yes';
                return $this->render('keyManagerkeyBundle:tpePage:addTpe.html.twig', array('clientnames'=> $clientnames,'error' => $error, 'selectedclient'=>$selectedclient));
            }
            else
            {
                $client = $em->getRepository('keyManagerkeyBundle:ClientNew')->find($clientname);
                $tpe->setTpeNum($tpenum);
                $tpe->setClientNew($client);
                $em->persist($tpe);
                $em->flush();
                return $this->redirect($this->generateUrl("TpeProfile_homePage"));
            }
        }


        return $this->render('keyManagerkeyBundle:tpePage:addTpe.html.twig', array('clientnames'=> $clientnames, 'error'=>$error, 'selectedclient'=>$selectedclient));
    }

    public function updateTpeAction($id, Request $request)
    {
        $error = '';
        $em = $this->getDoctrine()->getManager();
        $tpe = $em->getRepository('keyManagerkeyBundle:tpenew')->find($id);
        $post = Request::createFromGlobals();
        if($post->request->has('valider'))
        {
            $tpenum = $post->request->get('newNumTPE');
            $tpenumcheck = $em->getRepository('keyManagerkeyBundle:tpenew')->findOneBytpeNum($tpenum);
            if($tpenumcheck)
            {
                $error = 'yes';
                return $this->render('keyManagerkeyBundle:tpePage:updateTpe.html.twig', array('tpe'=>$tpe, 'error'=>$error));
            }
            else
            {
                $tpe->setTpeNum($tpenum);
                $em->persist($tpe);
                $em->flush();
                return $this->redirect($this->generateUrl("ClientProfile_homePage"));
            }
        }

        return $this->render('keyManagerkeyBundle:tpePage:updateTpe.html.twig', array('tpe'=>$tpe, 'error'=>$error));
    }
}
