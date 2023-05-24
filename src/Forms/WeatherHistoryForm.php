<?php

namespace App\Forms;

use App\DTO\WeatherHistoryInput;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class WeatherHistoryForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('page', IntegerType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Type(['type' => 'integer']),
                ],
            ])
            ->add('limit', IntegerType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Type(['type' => 'integer']),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WeatherHistoryInput::class,
            'csrf_protection' => false,
        ]);
    }

}