<?php

declare(strict_types = 1);

namespace App\Application\Form;

use App\Application\Dto\MoneyDto;
use Locale;
use NumberFormatter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;
use Throwable;

class MoneyFormType extends AbstractType
{
    /**
     * @param OptionsResolver $resolver
     *
     * @throws Throwable
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MoneyDto::class,
            'empty_data' => function (FormInterface $form) {
                $money = new MoneyDto();
                $money->currency = $this->getCurrencyCode();
                return $money;
            },
        ]);
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * @throws Throwable
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('amount', MoneyType::class, [
                'label' => false,
                'required' => true,
                'divisor' => 100,
                'currency' => $this->getCurrencyCode(),
                'constraints' => [
                    new NotBlank(),
                    new GreaterThanOrEqual(['value' => 0])
                ]
            ])
        ;
    }

    private function getCurrencyCode(): string
    {
        // NumberFormatter accepts English as a language for any country. So just use en_ plus country code.
        return (new NumberFormatter('en_'.Locale::getDefault(), NumberFormatter::CURRENCY))
            ->getTextAttribute(NumberFormatter::CURRENCY_CODE);
    }
}
