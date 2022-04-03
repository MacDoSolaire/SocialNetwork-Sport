<?php

namespace App\Form;

use App\Entity\Activite;
use App\Entity\Evenement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adresse', TextareaType::class)
            ->add('dateDeb', DateTimeType::class, [
                'widget' => 'choice'])
            ->add('dateFin', DateTimeType::class, [
                'widget' => 'choice'])
            ->add('visibilite', CheckboxType::class, ['required' => false])
            ->add('nbPers', TextAreaType::class)
            ->add('activites', EntityType::class, [
                'multiple' => true,
                'class' => Activite::class,
                'choice_label' => 'nom',
            ])
            ->add('message', TextAreaType::class, ['attr' => ["rows" => "20"]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
