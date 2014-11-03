<?php

namespace keyManager\keyBundle\Controller;

use keyManager\keyBundle\Entity\KeyNew;
use keyManager\keyBundle\Entity\Role;
use keyManager\keyBundle\Entity\User;
use keyManager\keyBundle\Form\KeyNewType;
use keyManager\keyBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\Constraints\Date;

class clefPageController extends Controller
{
    public function clefProfileAction()
    {
        $keys = new KeyNew();
        $form = $this->createForm(new KeyNewType($this->getDoctrine()->getManager()), $keys);
        return $this->render('keyManagerkeyBundle:clefPage:clefProfile.html.twig', array('form'=>$form->createView()));
    }

    public function addKeyAction(Request $request)
    {
//        $em = $this->getDoctrine()->getManager();
//        $clients = $em->getRepository('keyManagerkeyBundle:ClientNew')->findAll();
//        $tpes = $em->getRepository('keyManagerkeyBundle:tpenew')->findAll();
        $error = '';
        $key = new KeyNew();
        $form= $this->createForm(new KeyNewType($this->getDoctrine()->getManager()), $key);
        $form->handleRequest($request);

        if ($form->isValid()) {
            /* Do your stuff here */
            $data = $form->getData();
            $keyname = $data->getKeyName();
            $keynamecheck = $this->getDoctrine()->getManager()->getRepository('keyManagerkeyBundle:KeyNew')->findOneBykeyName($keyname);
            if($keynamecheck)
            {
                $error = 'yes';
                return $this->render('keyManagerkeyBundle:clefPage:addKey.html.twig', array('form'=>$form->createView(), 'error'=>$error));
            }
            else
            {
                $this->getDoctrine()->getManager()->persist($key);
                try
                {
                    $this->getDoctrine()->getManager()->flush();
                    return $this->redirect($this->generateUrl('ClientProfile_homePage'));
                }
                catch(\Exception $e)
                {
                 /*   if( $e->getCode() === '23000' )
                    {
                        echo "WRONG";

                        // Will output an SQLSTATE[23000] message, similar to:
                        // Integrity constraint violation: 1062 Duplicate entry 'x'
                        // ... for key 'UNIQ_BB4A8E30E7927C74'
                    }

                    else {throw $e; echo "else part";}*/
                    echo "clé pour nombre de TPE: ".$data->getTpenew()->getTpeNum(). " déjà existe.";
                }
                //return $this->redirect($this->generateUrl('ClientProfile_homePage'));
            }
        }

 //       return $this->render('keyManagerkeyBundle:clefPage:addKey.html.twig', array('clients'=>$clients, 'tpes'=>$tpes));
       return $this->render('keyManagerkeyBundle:clefPage:addKey.html.twig', array('form'=>$form->createView(), 'error'=>$error));

    }

    public function tpeAction(Request $request)
    {
//        $clientNew_id = $request->request->get('clientID');
//        $em = $this->getDoctrine()->getManager();
//        $tpes = $em->getRepository('keyManagerkeyBundle:tpenew')->findByClientID($clientNew_id);
//        return new JsonResponse($tpes);
        if (! $request->isXmlHttpRequest()) {
            throw new NotFoundHttpException();
        }

        // Get the province ID
        $id = $request->query->get('clientNew_id');

        $result = array();

        // Return a list of cities, based on the selected province
        $repo = $this->getDoctrine()->getManager()->getRepository('keyManagerkeyBundle:tpenew');
        $tpes = $repo->findByClientNew($id);
        foreach ($tpes as $tpe) {
            $result[$tpe->getTpeNum()] = $tpe->getId();
        }

        return new JsonResponse($result);
    }

    public function updateKeyAction($id)
    {
        //$key = new KeyNew();
        //$form = $this->createForm(new KeyNewType(), $key);
        //$form= $this->createForm(new KeyNewType($this->getDoctrine()->getManager()), $key);
        $error = '';
        $em = $this->getDoctrine()->getManager();
        $key = $em->getRepository('keyManagerkeyBundle:KeyNew')->find($id);
        $post = Request::createFromGlobals();
        if($post->request->has('valider'))
        {
            $keyname = $post->request->get('newKey');
            $keynamecheck = $em->getRepository('keyManagerkeyBundle:KeyNew')->findOneBykeyName($keyname);
            if($keynamecheck)
            {
                $error = 'yes';
                return $this->render('keyManagerkeyBundle:clefPage:updateKey.html.twig', array('key'=>$key, 'error'=>$error));
            }
            else
            {
                $key->setKeyName($keyname);
//                $sDate = $post->request->get('keyStart');
//                $eDate = $post->request->get('keyStop');
//                $startDate = date_create($sDate)->format('Y-m-d');
//                $endDate = date_create($eDate)->format('Y-m-d');
//                $key->setStartDate( \DateTime($startDate));
//                $key->setEndDate( strtotime($endDate));
                $em->persist($key);
                $em->flush();
                return $this->redirect($this->generateUrl("ClefProfile_homePage"));
            }
        }
        return $this->render('keyManagerkeyBundle:clefPage:updateKey.html.twig', array('key'=>$key, 'error'=>$error));
    }
}
  