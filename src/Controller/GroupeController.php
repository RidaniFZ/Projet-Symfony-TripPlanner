<?php

namespace App\Controller;

use App\Entity\groupe;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GroupeController extends AbstractController
{
    /**
     * @Route("/groupe/creation", name="groupe_creation")
     */
    public function groupeCreation(Request $request)
    {
        $myGroupe = new groupe();
        $myGroupe->setAdminGroupe($this->getUser());
        $formGroupeCreation = $this->createForm(GroupeFormType::class, $myGroupe);
        $formGroupeCreation->handleRequest($request);

        if ($formGroupeCreation->isSubmitted() && $formGroupeCreation->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($myGroupe);
            $entityManager->flush();
            return $this->redirectToRoute('groupe_list');
        }

        return $this->render('groupe/groupe_creation_form.html.twig',
        ['groupeCreationFormulaire' => $formGroupeCreation->createView(),'currentUser'=>$this->getUser()]);
    }

    /**
     * @Route("/groupe/list", name="groupe_list")
     */
    public function groupeList(Request $request)
    {
    
            $entityManager = $this->getDoctrine()->getManager();
            $rep = $entityManager->getRepository(groupe::class);
            //dd($this->getuser()->getId());
            $groupes = $rep->findBy(array('adminGroupe'=>$this->getuser()->getId())); /*($this->getuser()->getId());*/
            //dd($groupes);
            $rep = $entityManager->getRepository(User::class);
            $groupeMembers=$rep->findAll();
            //dd($groupeMembers);
            return $this->render('groupe/groupe_list.html.twig',['listGroupes'=> $groupes,
                                                                 'listMembre'=>$groupeMembers,
                                                                 'currentUser'=>$this->getUser()]);

   }
   /**
     * @Route("/add/groupe/member", name="add_groupe_member")
     */
    public function addGroupeMember(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $rep = $entityManager->getRepository(groupe::class);
        //dd($request->request->get('groupeId'));
        //$request->request->get('lesMembres'));
        $groupe=$rep->find($request->request->get('groupeId'));
        $rep = $entityManager->getRepository(User::class);
        $user=$rep->find($request->request->get('lesMembres'));
        $groupe->addUserGroupe($user);
        $entityManager->flush();
        return $this->redirectToRoute('groupe_list');
    }
    /**
     * @Route("edit/groupe/{id}", name="edit_groupe")
     */
    public function editGroupe(Request $request, $id)
    {  
      // $currentGroupeID = $request->request->get('editGroupeId');
        $groupeUpdated=new groupe();
        
        $formEditGroupe = $this->createForm( GroupeFormType::class, $groupeUpdated);
        
        $formEditGroupe->handleRequest($request);
        
        if ($formEditGroupe->isSubmitted() && $formEditGroupe->isValid())
        { 
           
           $em = $this->getDoctrine()->getManager();
           $rep = $em->getRepository(groupe::class);
           $groupeToUpdated=$rep->find($id);

           $groupeToUpdated->setNom($groupeUpdated->getNom());
           $groupeToUpdated->setDescription($groupeUpdated->getDescription());

           $em->flush();
           return $this->redirectToRoute('groupe_list');
        }
        return $this->render(
            '/groupe/afficher_formulaire_edit_groupe.html.twig',
            ['editGroupeFormulaire' => $formEditGroupe->createView(),'currentUser'=>$this->getUser()]
        );
    }
    /**
     * @Route("delete/groupe/{id}", name="delete_groupe")
     */
    public function deleteGroupe($id)
    {  
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(groupe::class);
        $groupeToUpdated=$rep->find($id);
        $em->remove($groupeToUpdated);
        $em->flush();
        return $this->redirectToRoute('groupe_list');
    }
    /**
     * @Route("joined/groupe}", name="joined_groupe")
     */
    public function joinedGroupe()
    {
      $groupes = $this->getUser()->getGroupesAppartenance();
      return $this->render('/groupe/joined_groupe.html.twig',['listGroupes'=>$groupes, 'currentUser'=>$this->getUser()]);
    }

}