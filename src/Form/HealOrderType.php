<?php

namespace App\Form;

use App\Entity\HealOrder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HealOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('kind')
            ->add('zipcode')
            ->add('content')
            ->add('created_at')
            ->add('completed_at')
            ->add('user_id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HealOrder::class,
        ]);
    }
}
