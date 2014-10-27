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

    public  function addTpeAction(Request $request)
    {
        $error = '';
        $em = $this->getDoctrine()->getManager();
        $tpe = new tpenew();
        $clientnames = $em->getRepository('keyManagerkeyBundle:ClientNew')->findAll();
        $post = Request::createFromGlobals();
        if($post->request->has('valider'))
        {
            $tpenum = $post->request->get('numTPE');
            $clientname = $post->request->get('client_company');
            $tpenumcheck = $em->getRepository('keyManagerkeyBundle:tpenew')->findOneBytpeNum($tpenum);
            if($tpenumcheck)
            {
                $error = 'yes';
                return $this->render('keyManagerkeyBundle:tpePage:addTpe.html.twig', array('clientnames'=> $clientnames,'error' => $error));
            }
            else
            {
                $client = $em->getRepository('keyManagerkeyBundle:ClientNew')->find($clientname);
                $tpe->setTpeNum($tpenum);
                $tpe->setClientNew($client);
                $em->persist($tpe);
                $em->flush();
                return $this->redirect($this->generateUrl("UpdateClient_ClientProfile"));
            }
        }


        return $this->render('keyManagerkeyBundle:tpePage:addTpe.html.twig', array('clientnames'=> $clientnames, 'error'=>$error));
    }
}
