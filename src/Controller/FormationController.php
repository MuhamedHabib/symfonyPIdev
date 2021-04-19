<?php

namespace App\Controller;

use App\Entity\Myformation;
use App\Form\FormationType;
use App\Repository\MyformationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationController extends AbstractController
{
    /**
     * @Route("/formation", name="formation")
     */
    public function index(): Response
    {
        return $this->render('layout.html.twig', [
            'controller_name' => 'FormationController',
        ]);
    }

    /**
     * @Route("/add/formation", name="add_formation")
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function addFormation(Request $request)
    {
        $formation = new Myformation();

        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $formation= $form->getData();
            // On récupère les images transmises
            $file = $form->get('image')->getData();

            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            // moves the file to the directory where brochures are stored
            try {
                $file->move(
                    $this->getParameter('brochures_directory'), $fileName);
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            $formation->setImage($fileName);
            $em->persist($formation);
            $em->flush();

            return $this->redirectToRoute('list_formation');
        }
        return $this->render('formation/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/formation/list", name="list_formation")
     */
    public function list ()
    {
        $em = $this->getDoctrine()->getManager();
        $formation = $em->getRepository(Myformation::class)->findAll();

        return $this->render('formation/list.html.twig', [
            'formations' => $formation,
        ]);
    }


    /**
     * @Route("/formation/edit/{id}", name="edit_formation")
     * @param $id
     * @param MyformationRepository $repository
     * @param Request $request
     * @return RedirectResponse|Response
     */
    function editFormation($id,MyformationRepository $repository,\Symfony\Component\HttpFoundation\Request $request){

        $formation=$repository->find($id);
        $editform=$this->createForm(FormationType::class,$formation);
        $editform->handleRequest($request);
        if ($editform->isSubmitted() && $editform->isValid()){

            $formation= $editform->getData();
            // On récupère les images transmises
            $file = $editform->get('image')->getData();

            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            // moves the file to the directory where brochures are stored
            try {
                $file->move(
                    $this->getParameter('brochures_directory'), $fileName);
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            $em=$this->getDoctrine()->getManager();

            $formation->setImage($fileName);
            $em->flush();

            return $this->redirectToRoute("list_formation");
        }
        return $this->render('product/edit.html.twig',
            [
                'editform'=>$editform->createView()
            ]);
    }



    /**
     * @Route("/formation/delete/{id}", name="delete_formation")
     *
     */
    public function deleteFormation($id){

        $em = $this->getDoctrine()->getManager();
        $formation =$em->getRepository(Myformation::class)->find($id);


        $em->remove($formation);
        $em->flush();
        return $this->redirectToRoute('list_product');
    }


}
