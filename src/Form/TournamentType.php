<?php

namespace App\Form;

use App\Entity\Tournament;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TournamentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $teams = [];

        foreach ($options['teams'] as $team) {
            $teams[$team] = $team;
        }

        $builder
            ->add('name')
            ->add('matches', ChoiceType::class, [
                'choices'  => $teams,
                'label' => 'Teams (default all)',
                'multiple' => true,
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tournament::class,
            'teams' => null,
        ]);
    }
}
