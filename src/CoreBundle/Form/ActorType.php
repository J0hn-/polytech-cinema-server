<?php

namespace CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('birthday', DateTimeType::class, array(
                'widget' => 'single_text',
                'input' => 'datetime'
            ))
            ->add('deathday', DateTimeType::class, array(
                'widget' => 'single_text',
                'input' => 'datetime'
            ))
            ->add('firstName')
            ->add('lastName')
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CoreBundle\Entity\Actor',
            'csrf_protection' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'corebundle_actor';
    }


}
