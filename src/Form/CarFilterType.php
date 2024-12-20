<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\CarType as CarTypeEntity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CarFilterType  extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('brand', TextType::class, [
                'required' => false,
                'label' => 'Brand',
            ])
            ->add('model', TextType::class, [
                'required' => false,
                'label' => 'Model',
            ])
            ->add('type', EntityType::class, [
                'class' => CarTypeEntity::class,
                'required' => false,
                'choice_label' => 'name',
            ])
            ->add('color', TextType::class, [
                'required' => false,
                'label' => 'Color',
            ])
            ->add('nbSeat',  ChoiceType::class, [
                'choices' => [
                    '0 - 2' => 0,
                    '3 - 5' => 3,
                    '6 +' => 6
                ],
                'required' => false,
                'label' => 'nbSeat',
            ])
            ->add('ptra', ChoiceType::class, [
                'choices' => [
                    '0 - 1000' => 0,
                    '1000 - 1999' => 1000,
                    '2000 - 2999' => 2000,
                    '3000 +' => 3000,
                ],
                'required' => false,
                'label' => 'PTRA',
            ])
            ->add('search', submitType::class);
    }
}
