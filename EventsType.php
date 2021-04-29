<?php

namespace App\Form;

use App\Entity\Events;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomEvent')
            ->add('dateDeb')
            ->add('dateFin')
            ->add('nbr_place')
            ->add('categorie', EntityType::class,
            [
                'class'=>Categorie::class,
                'choice_label'=>'nomcategorie'
            ])
            ->add('image', FileType::class, [
                'label'=>'Image',
                'mapped'=> false

            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Events::class,
        ]);
    }
}
