<?php

namespace App\Form;

use App\Entity\Order;
use App\Entity\Consumer;
use App\Entity\Package;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('consumer', EntityType::class, [
                'class' => Consumer::class,

                'choice_label' => function (Consumer $consumer) {
                    return $consumer->getFirstName() . ' ' . $consumer->getLastName();
                },
                'label' => 'Select Customer',
                'placeholder' => 'Choose a customer...',
            ])
            ->add('package', EntityType::class, [
                'class' => Package::class,
                'choice_label' => 'name',
                'label' => 'Select Package / Menu',
                'placeholder' => 'Choose a package...',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
