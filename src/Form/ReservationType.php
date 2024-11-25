<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Utilisateur;
use App\Entity\Ordinateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reservationDate', DateTimeType::class, [
                'label' => 'Date de réservation',
                'widget' => 'single_text',
                'html5' => true,
            ])
            ->add('utilisateur', EntityType::class, [
                'class' => Utilisateur::class,
                'choice_label' => 'username',
                'label' => 'Utilisateur',
                'placeholder' => 'Sélectionnez un utilisateur',
            ])
            ->add('ordinateur', EntityType::class, [
                'class' => Ordinateur::class,
                'choice_label' => 'name',
                'label' => 'Ordinateur',
                'placeholder' => 'Sélectionnez un ordinateur',
                'query_builder' => function (\App\Repository\OrdinateurRepository $repo) {
                    return $repo->createQueryBuilder('o')
                        ->where('o.isAvailable = true');
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
