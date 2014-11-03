<?php

namespace keyManager\keyBundle\Form\EventListener;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use keyManager\keyBundle\Entity\tpenew;
use keyManager\keyBundle\Entity\ClientNew;

class AddTpenewFieldSubscriber implements EventSubscriberInterface
{

    private $propertyPathToTpe;

    public function _construct($propertyPathToTpe)
    {
        $this->propertyPathToTpe = $propertyPathToTpe;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA  => 'preSetData',
            FormEvents::PRE_SUBMIT    => 'preSubmit'
        );
    }

    private function addTpeForm($form, $clientNew_id)
    {
        $formOptions = array(
            'class' => 'keyBundle:tpenew',
            'empty_value' => 'select tpe num',
            'label' => 'TPE num',
            'attr' => array('class' => 'tpe_selector'),
            'query_builder' => function (EntityRepository $repository) use ($clientNew_id) {
                $qb = $repository->createQueryBuilder('tpenew')
                    ->innerJoin('tpenew.clientNew', 'ClientNew')
                    ->where('ClientNew.id = :ClientNew')
                    ->setParameter('ClientNew', $clientNew_id)
                ;

                return $qb;
            }
        );
        $form->add($this->propertyPathToTpe, 'entity', $formOptions);
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        $accessor    = PropertyAccess::createPropertyAccessor();
        if ($accessor->isReadable($data, $this->propertyPathToTpe)){echo 'working';} else {echo 'not workin';}

        $tpe        = $accessor->getValue($data, $this->propertyPathToTpe);
        $client_id = ($tpe) ? $tpe->getClientNew()->getId() : null;

        $this->addTpeForm($form, $client_id);
    }

    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        $client_id = array_key_exists('ClientNew', $data) ? $data['ClientNew'] : null;

        $this->addTpeForm($form, $client_id);
    }
}