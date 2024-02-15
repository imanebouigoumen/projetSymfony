<?php

namespace App\Form;

use App\Entity\Lecon;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType; // Added







class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [ // Utilisez ChoiceType pour les rôles
                'choices' => [
                    'ROLE_PROF' => 'ROLE_PROF', // Ajoutez les rôles disponibles ici
                    'ROLE_ADMIN' => 'ROLE_ADMIN',
                ],
                'multiple' => true, // Autorisez la sélection de plusieurs rôles si nécessaire
            ])
            ->add('password')
            ->add('nom')
            ->add('prenom')
            ->add('listelecons', EntityType::class, [
                'class' => Lecon::class,
                'choice_label' => 'id',
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
