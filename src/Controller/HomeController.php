<?php

namespace App\Controller;

use App\Entity\Trip;
use App\Entity\User;
use App\Entity\Groupe;
use App\Entity\Activit;
use App\Form\ContactType;
use App\Entity\Hebergement;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class HomeController extends AbstractController
{
    /** 
     * @Route("/" , name="index")
     */
    public function index()
    {
        return $this->render('home/index.html.twig');
    }
    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render('home/about.html.twig');
    }

   /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('home/contact.html.twig');
    } 

   /**
     * @Route("/contact/traitement", name="contact_traitement")
     */
    public function contactTraitement(Request $req, \Swift_Mailer $mailer)
    {
       
           $Contact =['Firstname'=>$req->request->get('Firstname'),
                    'Lastname'=>$req->request->get('Lastname'),
                    'email'=> $req->request->get('email') , 
                    'subject'=>$req->request->get('subject'), 
                    'message'=>$req->request->get('message') ];
         //dd($Contact);
           $message = (new \Swift_Message('Neauvau Contact'))
          ->setFrom($req->request->get("email"))
          ->setTo('ridani.fz@gmail.com')
          ->setBody(
            $this->renderView(
                'email/email_contact.html.twig',
                ['Contact' => $Contact]
            ),
            'text/html'
          
          ); 
          $mailer->send($message);
        $this->addFlash('message','Thank You! Message Sent with Success');
        return $this->redirectToRoute('index');
    }
    /**
     * @Route("/term/Of/Use", name="termOfUse")
     */
    public function termOfUse()
    {
        return $this->render('home/term_of_use.html.twig');
    }

    /**
     * @Route("/sign/up", name="signUp")
     */
    public function signUp(Request $req, UserPasswordEncoderInterface $encoder)
    {
       $em = $this->getDoctrine()->getManager();
       $user = new User();
       $user->setNom($req->request->get('nom'));
       $user->setPrenom($req->request->get('prenom'));
       $user->setPays($req->request->get('pays'));
       $user->setAdress($req->request->get('adress'));
       $user->setEmail($req->request->get('email'));
       $user->setDescription($req->request->get('description'));
       // j'encode le password manuellement avant le stocker dans la base de donnée.
       $encodedPassword = $encoder->encodePassword($user, $req->request->get('password'));
       $user->setPassword($encodedPassword);
       
       //dd($req->files->get('image'));
       
            //upload fichier (photo de profile)
            $fichier = $req->files->get('image');
            //dump($fichier );
            //die();
            
            $nomFichierServeur = md5(uniqid()) . "." . $fichier->guessExtension();
            // stocker le fichier dans le serveur (on peut indiquer un dossier)
            $fichier->move("dossierFichiers", $nomFichierServeur);
            // affecter le nom du fichier de l'entité. Ça sera le nom qu'on
            // aura dans la BD (un string, pas un objet UploadedFile cette fois)
            $user->setImage($nomFichierServeur);

       $em->persist($user);
       $em->flush(); 
       $this->addFlash('message','Thank You! Registretion Done with Success, Please Log In To Member Area');
      return $this->redirectToRoute('app_login');
    }

    /**
     * @Route("/search/trip" , name="search_trip")
     */
     public function searchTrip(Request $req)
    {  //dd($req->request->get('destination'));
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Trip::class);
        $Trips=$rep->findBy(array('Destination'=> $req->request->get('destination')));
        /* $rep = $em->getRepository(Hebergement::class);
        $Hebergement = $rep->find($Trips->geTripHebergement()->getId()); */

        return $this->render('home/search_trips.html.twig',['listTrips'=> $Trips]);
    }

    /**
     * @Route("/join/groupe/{id}" , name="join_groupe")
     */
    public function JoinGroupe(Request $req, $id)
    {  
        // ici je dois vérifier que l'utilisateur est logger.
        //si l'utilisateur est logger
        $entityManager = $this->getDoctrine()->getManager();
        $rep = $entityManager->getRepository(Groupe::class);
        //dd($request->request->get('groupeId'));
        //$request->request->get('lesMembres'));
        $groupe=$rep->find($id);
        $rep = $entityManager->getRepository(User::class);
        $groupe->addUserGroupe($this->getUser());
        $entityManager->flush();
        return $this->redirectToRoute('joined_groupe');
    }
    /**
     * @Route("/get/Activities/{id}" , name="get_activities")
     */
    public function getActivities(Request $req, $id)
    {  
        $entityManager = $this->getDoctrine()->getManager();
        $rep = $entityManager->getRepository(Trip::class);
        $Trip=$rep->find($id);
       // $rep = $entityManager->getRepository(Activit::class);
        $Activities = $rep->findBy(array('TripActivities'=>$Trip->getTripActivities()));
        dd($Activities);
        return new JsonResponse($Activities);
    }
}
