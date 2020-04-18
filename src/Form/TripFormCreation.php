<?php

namespace App\Controller;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class TripFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('destination', TextType::class)
        ->add('dateDebut', DateType::class)
        ->add('dateFin', DateType::class)
        ->add('description', TextType::class)
        ->add('image', FileType::class , array ('label'=>"Choose a picture for your destination."));
    }

}

?>