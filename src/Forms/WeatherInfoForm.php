<?php

namespace App\Forms;

use App\DTO\WeatherInfoInput;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class WeatherInfoForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lat', NumberType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Type(['type' => 'float']),
                ],
            ])
            ->add('lng', NumberType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Type(['type' => 'float']),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WeatherInfoInput::class,
            'csrf_protection' => false,
        ]);
    }
}