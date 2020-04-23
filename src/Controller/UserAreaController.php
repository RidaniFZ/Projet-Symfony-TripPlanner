<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
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

        $monprofil = $rep->find($currentUser->getId());

        $vars = ['monprofil' => $monprofil];
        return $this->render('user_area/index.html.twig', $vars);
        
    }

    /**
     * @Route("/user/area/edit/profile", name="edit_profile")
     */
    public function editProfile(Request $req, UserPasswordEncoderInterface $passwordEncoder)
    {   $userUpdated = $this->getUser();
        $userUpdated->setImage(null);

        // créer le formulaire        
        $formEditProfile = $this->createForm(
            UserFormType::class,
            $userUpdated,
            [
                'method' => 'POST',
                'action' => $this->generateUrl("edit_profile")

            ] 
        );
       
        $formEditProfile->handleRequest($req);
         if ($formEditProfile->isSubmitted() && $formEditProfile->isValid())
        { 
            
           $em = $this->getDoctrine()->getManager();
           $rep = $em->getRepository(User::class);
           $userUpdated->setPassword(
            $passwordEncoder->encodePassword(
                $userUpdated,
                $formEditProfile->get('password')->getData()
            )
        );
        $fichier = $userUpdated->getImage();
    
            $nomFichierServeur = md5(uniqid()) . "." . $fichier->guessExtension();

            $fichier->move("dossierFichiers", $nomFichierServeur);
  
            $userUpdated->setImage($nomFichierServeur);
           $em->flush();
           
           $vars = ['monprofil' => $userUpdated];
        return $this->render('user_area/index.html.twig', $vars);
        }
        return $this->render(
            '/user_area/afficher_formulaire_edit_profile.html.twig',
            ['editProfileFormulaire' => $formEditProfile->createView(),
            'monprofil'=>$this->getUser()]
        );
    }

    /**
     * @Route("/search/contact" , name="search_contact")
     */
    public function searchContact(Request $req)
    {  
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(User::class);
        $contacts=$rep->findBy(array('Nom'=> $req->request->get('nom')));
        if($contacts==null)
        {
            $this->addFlash('message','Contact Not found !' );
        }
        return $this->render('/user_area/search_contact.html.twig',['listContact'=> $contacts,'currentUser'=>$this->getUser()]);
    }
}
