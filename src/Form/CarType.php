<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use App\Entity\CarType as CarTypeEntity;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('brand')
            ->add('model')
            ->add('type', EntityType::class, [
                'class' => CarTypeEntity::class,
                'choice_label' => 'name',
            ])
            ->add('nbSeat', IntegerType::class, [
                'constraints' => [new PositiveOrZero()],
                'attr' => [
                    'min' => 0,
                ]
            ])
            ->add('color')
            ->add('ptra', IntegerType::class, [
                'constraints' => [new PositiveOrZero()],
                'attr' => [
                    'min' => 0,
                ],
                'empty_data' => 0,
            ])
            ->add('create', submitType::class)
        ;


        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();
            $newCar = $event->getData();

            if ($newCar->getType()->getId() === 3 && $newCar->getPtra() <= 0) {
                $form->get('ptra')->addError(new FormError('Le PTRA doit être superieur à 0'));
            }
        });

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class
        ]);
    }
}
