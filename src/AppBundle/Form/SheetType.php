<?php
/**
 * Created by PhpStorm.
 * User: rvck2
 * Date: 07/11/2018
 * Time: 06:39
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class SheetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('name', null, array('label' => 'Nom de l\'album'))
            ->add('type')
            ->add('artist')
            ->add('duration')
            // ->add('released', 'birthday')
            ->add('released', 'date')
            ->add('published', 'date', array('mapped' => false))
            ->add('submit', 'submit')
            ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Sheet'
        ));
    }

    public function getName()
    {
        return 'sheet_form';
    }
}