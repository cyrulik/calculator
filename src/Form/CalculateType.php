<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class CalculateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('operation', ChoiceType::class, [
                'choices' => [
                    'Add' => 'addition',
                    'Subtract' => 'subtraction',
                    'Multiply' => 'multiplication',
                    'Divide' => 'division',
                ],
                'constraints' => [
                    new NotBlank(),
                ],
                'label' => 'Operation',
            ])
            ->add('a', NumberType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Type('numeric'),
                ],
                'label' => 'Number A',
            ])
            ->add('b', NumberType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Type('numeric'),
                ],
                'label' => 'Number B',
            ])
            ->add('calculate', SubmitType::class, ['label' => 'Calculate']);
    }
}
