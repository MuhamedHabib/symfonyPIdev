<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Events;
use App\Entity\Personne;
use App\Entity\Participation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('events', EntityType::class,
                [
                    'class'=>Events::class,
                    'choice_label'=>'nomEvent'
                ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participation::class,
        ]);
    }
}
