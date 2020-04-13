<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('adress', TextType::class)
            ->add('pays', TextType::class)
            ->add('image', FileType::class , array ('label'=>"Sélectionnez une photo de profile."))
            -> add('email', EmailType::class)
            ->add('password', PasswordType::class);
            //->add ('envoyer', SubmitType::class);  // à ne pas faire!!!
    }
}


?>