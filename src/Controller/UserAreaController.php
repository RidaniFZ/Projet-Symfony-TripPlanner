<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserAreaController extends AbstractController
{
    /**
     * @Route("/user/area", name="user_area")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(User::class);

        $currentUser = $this->getUser();
        //dump($currentUser->getId());
        //die();
        $monprofil = $rep->find($currentUser->getId());
   /*      dump($monprofil);
        die(); */

        $vars = ['monprofil' => $monprofil];
        return $this->render('user_area/index.html.twig', $vars);
        
    }

    /**
     * @Route("/user/area/edit/profile", name="edit_profile")
     */
    public function editProfile(Request $req, UserPasswordEncoderInterface $passwordEncoder)
    {   $userUpdated = new User();
        $currentUser = $this->getUser();
        // créer le formulaire        
        $formProfile = $this->createForm(
            RegistrationFormType::class,
            $userUpdated,
            [
                'method' => 'POST',
                'action' => $this->generateUrl("edit_profile")

            ]
        );

        $formProfile->handleRequest($req);
      
         if ($formProfile->isSubmitted() && $formProfile->isValid())
        { 

           $em = $this->getDoctrine()->getManager();
           $rep = $em->getRepository(User::class);
           $userToUpdate= $rep->find($currentUser->getId());
           dd($userUpdated);
           $userToUpdate->setPrenom($userUpdated->getPrenom());
           $userToUpdate->setNom($userUpdated->getNom());
           $userToUpdate->setPays($userUpdated->getPays());
           $userToUpdate->setAdress($userUpdated->getAdress());
           $userToUpdate->setEmail($userUpdated->getEmail());
           $userToUpdate->setPassword(
            $passwordEncoder->encodePassword(
                $userUpdated,
                $formProfile->get('plainPassword')->getData()
            )
        );
        $fichier = $userUpdated->getImage();
    
            $nomFichierServeur = md5(uniqid()) . "." . $fichier->guessExtension();

            $fichier->move("dossierFichiers", $nomFichierServeur);
  
            $userToUpdate->setImage($nomFichierServeur);

           $em->flush();
           //dd($userToUpdate);
           $vars = ['monprofil' => $userUpdated];
        return $this->render('user_area/index.html.twig', $vars);
        }
        return $this->render(
            '/user_area/afficher_formulaire_edit_profile.html.twig',
            ['editProfileFormulaire' => $formProfile->createView()]
        );
    }
}
