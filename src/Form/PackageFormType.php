<?php

namespace App\Form;

use App\Entity\Package;
use App\Entity\Category;
use App\Entity\Business;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PackageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Package Name'
            ])
            ->add('description', TextType::class, [
                'label' => 'Description'
            ])
            ->add('price', NumberType::class, [
                'label' => 'Price'
            ])
            ->add('photo', TextType::class, [
                'label' => 'Photo URL / Path',
                'required' => false
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'label' => 'Category',
                'placeholder' => 'Choose a category...'
            ])
            ->add('business', EntityType::class, [
                'class' => Business::class,
                'choice_label' => 'name',
                'label' => 'Assign to Business',
                'placeholder' => 'Choose a business...'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Package::class,
        ]);
    }
}
