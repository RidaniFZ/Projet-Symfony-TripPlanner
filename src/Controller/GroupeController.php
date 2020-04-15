<?php

namespace App\Controller;

use App\Entity\groupe;
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
            return $this->render('home/index.html.twig');
        }

        return $this->render('groupe/groupe_creation_form.html.twig',
        ['groupeCreationFormulaire' => $formGroupeCreation->createView()]);
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
            return $this->render('groupe/groupe_list.html.twig',['listGroupes'=> $groupes]);

   }
}