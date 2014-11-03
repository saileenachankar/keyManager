<?php

namespace keyManager\keyBundle\Form\EventListener;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

class AddClientNewFieldSubscriber implements  EventSubscriberInterface
{
    private $propertyPathToTpe;

    public function _construct($propertyPathToTpe)
    {
        $this->propertyPathToTpe = $propertyPathToTpe;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT   => 'preSubmit'
        );
    }

    private function addClientForm($form, $client = null)
    {
        $formOptions = array(
            'class' => 'keyManager\keyBundle\Entity\ClientNew',
            'mapped' => 'false',
            'label' => 'Client name',
            'empty_value' => 'select client'
        );

        if($client)
        {
            $formOptions['data'] = $client;
        }
        $form->add('client', 'entity', $formOptions);
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        $accessor = PropertyAccess::createPropertyAccessorBuilder()
            ->getPropertyAccessor();

        $tpe    = $accessor->getValue($data, $this->propertyPathToTpe);
        $client = ($tpe) ? $tpe->getClientNew() : null;

        $this->addClientForm($form, $client);
    }

    public function preSubmit(FormEvent $event)
    {
        $form = $event->getForm();

        $this->addClientForm($form);
    }
}