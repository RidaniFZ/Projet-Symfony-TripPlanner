<?php

namespace App\Controller;

use App\Entity\Trip;
use App\Entity\groupe;
use App\Entity\Hebergement;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TripController extends AbstractController
{
    /**
     * @Route("/trip/creation", name="trip_creation")
     */
    public function tripCreation(Request $request)
    { 
        $myTrip = new Trip();
        $myTrip->setTripAdmin($this->getUser());

        // ici je récupére les groupe crée par le user courant (l'admin de trip qui est l'admin de groupe aussi)
        $entityManager = $this->getDoctrine()->getManager();
        $rep = $entityManager->getRepository(groupe::class);
        $groupes=$rep->findBy(array('adminGroupe'=> $this->getUser()));
       // au moment de la creation de trip je dois crée l'hebergement liée avec. donc dans cette action j'utilise deux forms
       // fromTripcreation et HebergementTripCreation, et je renvoie les deux fomr à la vue.
       $hebergement = new Hebergement();
       $formHebergementCreation = $this->createForm(HebergementFormType::class, $hebergement);
       $formHebergementCreation->handleRequest($request);
       $myTrip->setTripHebergement($hebergement);
     
        $formTripCreation = $this->createForm(TripFormType::class, $myTrip);
        $formTripCreation->handleRequest($request);


        if ($formTripCreation->isSubmitted() && $formTripCreation->isValid())
         {
 
            $fichier = $formTripCreation->get('image')->getData();;
        
            $nomFichierServeur = md5(uniqid()) . "." . $fichier->guessExtension();
            $fichier->move("dossierFichiers", $nomFichierServeur);
 
            $myTrip->setImage($nomFichierServeur);
           //je récupére le groupe choisit par le user admin lors de la creation de trip.
            $groupe=$rep->find($request->request->get('lesGroupes'));
            $myTrip->setTripGroupe($groupe);

            $entityManager->persist($hebergement);
            $entityManager->persist($myTrip);
            $entityManager->flush();
            return $this->redirectToRoute('trip_list');
        }


        return $this->render('trip/trip_creation_form.html.twig',
        ['tripCreationFormulaire' => $formTripCreation->createView(),
        'hebergementCreationFormulaire' => $formHebergementCreation->createView(),
        'listeGroupe'=>$groupes,
        'currentUser'=>$this->getUser()]);
    }

    /**
     * @Route("/trip/list", name="trip_list")
     */
    public function tripList()
    {   
        $entityManager = $this->getDoctrine()->getManager();    
        $rep = $entityManager->getRepository(Trip::class);
        $Trips = $rep->findBy(array('TripAdmin'=>$this->getuser()->getId())); /*($this->getuser()->getId());*/
        return $this->render('trip/trip_list.html.twig',['listTrips'=> $Trips,  'currentUser'=>$this->getUser()]);
    }
    /**
     * @Route("delete/trip/{id}", name="delete_trip")
     */
    public function deleteTrip($id)
    {  
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Trip::class);
        $TripToDelete=$rep->find($id);
        $em->remove($TripToDelete);
        $em->flush();
        return $this->redirectToRoute('trip_list');
    }

     /**
     * @Route("edit/trip/{id}", name="edit_trip")
     */
    public function editTrip(Request $request, $id)
    {  
      // $currentGroupeID = $request->request->get('editGroupeId');
        $tripUpdated=new Trip();
        $hebergementUpdated=new hebergement();

        $formEditTrip = $this->createForm( TripFormType::class, $tripUpdated);
       
        $formEditHebergement = $this->createForm( HebergementFormType::class, $hebergementUpdated);

        $formEditTrip->handleRequest($request);
        $formEditHebergement->handleRequest($request);

        if ($formEditTrip->isSubmitted() && $formEditTrip->isValid())
        { 
           $em = $this->getDoctrine()->getManager();
           $rep = $em->getRepository(Trip::class);
           $tripToUpdated=$rep->find($id);

           $rep = $em->getRepository(Hebergement::class);
           $hebergementToUpdated = $rep->find($tripToUpdated->getTripHebergement()->getId());
           

           $hebergementToUpdated->setAdress($hebergementUpdated->getAdress());
           $hebergementToUpdated->setPrixParNuit($hebergementUpdated->getPrixParNuit());
           $hebergementToUpdated->setType($hebergementUpdated->getType());
           
           $tripToUpdated->setDestination($tripUpdated->getDestination());
           $tripToUpdated->setDescription($tripUpdated->getDescription());
           $tripToUpdated->setDateDebut($tripUpdated->getDateDebut());
           $tripToUpdated->setDateFin($tripUpdated->getDateFin());
           $tripToUpdated->setDescription($tripUpdated->getDescription());
           $fichier = $formEditTrip->get('image')->getData();
           $nomFichierServeur = md5(uniqid()) . "." . $fichier->guessExtension();
           $fichier->move("dossierFichiers", $nomFichierServeur);

           $tripToUpdated->setImage($nomFichierServeur);
     
           $em->flush();
           return $this->redirectToRoute('trip_list');
        }
        return $this->render(
            '/trip/modal_formulaire_edit_trip.html.twig',
            ['tripEditFormulaire' => $formEditTrip->createView(),
            'hebergementEditFormulaire'=>$formEditHebergement->createView(),
            'currentUser'=>$this->getUser()]
        );
    }
}
