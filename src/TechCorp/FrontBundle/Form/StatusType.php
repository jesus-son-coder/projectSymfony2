<?php

namespace TechCorp\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StatusType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content')
            /*
            ->add('deleted')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('user') */
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TechCorp\FrontBundle\Entity\Status'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'techcorp_frontbundle_status';
    }
}
