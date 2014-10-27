<?php

namespace keyManager\keyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class KeyNewType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', 'date', array('widget' => 'single_text'))
            ->add('endDate', 'date', array('widget' => 'single_text'))
            ->add('keyName')
            ->add('keyValid')
            ->add('tpenew', 'entity',  array(
                    'class' => 'keyManagerkeyBundle:tpenew',
                    'property' => 'tpeNum'));

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'keyManager\keyBundle\Entity\KeyNew'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'keymanager_keybundle_keynew';
    }
}
