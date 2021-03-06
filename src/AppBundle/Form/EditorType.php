<?php
/**
 * Created by PhpStorm.
 * User: rvck2
 * Date: 13/11/2018
 * Time: 13:51
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EditorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //parent::buildForm($builder, $options); // TODO: Change the autogenerated stub
        $builder
            ->add('titre')
            ->add('contenu', 'ckeditor', array('config_name' => 'basic_config'))
            ->add('service')
            ->add('datePublication', 'date')
            ->add('lang')
            ->add('publicated', 'choice', array(
                'choices' => array(
                    'yes' => "Oui", 'no' => "Non"
                ),
                'multiple' => false,
                'expanded' => true,
                'preferred_choices' => array(1)
                // 'empty_value' => '- Choisissez une option -',
                // 'empty_data'  => -1
            ))
            ->add('submit', 'submit')
            ;
    }

    public function getName()
    {
        return 'editor';
    }
}