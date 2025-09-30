<?php

namespace Training\Bundle\CollectOnDeliveryBundle\Form\Type;

use Oro\Bundle\LocaleBundle\Form\Type\LocalizedFallbackValueCollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Training\Bundle\CollectOnDeliveryBundle\Entity\CollectOnDeliverySettings;

class CollectOnDeliverySettingsType extends AbstractType
{
    const BLOCK_PREFIX = 'collect_on_delivery_setting_type';

    #[\Override]
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'labels',
                LocalizedFallbackValueCollectionType::class,
                [
                    'label' => 'collect_on_delivery.settings.labels.label',
                    'required' => true,
                    'entry_options' => ['constraints' => [new NotBlank()]]
                ]
            )
            ->add(
                'shortLabels',
                LocalizedFallbackValueCollectionType::class,
                [
                    'label' => 'collect_on_delivery.settings.short_labels.label',
                    'required' => true,
                    'entry_options' => ['constraints' => [new NotBlank()]]
                ]
            );
    }

    #[\Override]
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CollectOnDeliverySettings::class,
        ]);
    }

    #[\Override]
    public function getBlockPrefix(): string
    {
        return self::BLOCK_PREFIX;
    }
}