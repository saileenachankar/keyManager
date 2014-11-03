<?php

namespace keyManager\keyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class tpenewType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tpeNum')
            ->add('clientNew', 'entity',  array(
                    'class' => 'keyManagerkeyBundle:ClientNew',
                    'property' => 'clientCompany'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'keyManager\keyBundle\Entity\tpenew'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'keymanager_keybundle_tpenew';
    }
}
