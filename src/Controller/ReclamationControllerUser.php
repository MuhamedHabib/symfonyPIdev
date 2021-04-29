<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @Route("/reclamation/controller/user")
 */
class ReclamationControllerUser extends AbstractController
{
    /**
     * @Route("/", name="reclamation_controller_user_index",methods={"GET"})
     */
    public function index(ReclamationRepository $reclamationRepository,Request $request, PaginatorInterface $paginator):Response
    {
        $donnees = $this->getDoctrine()->getRepository(Reclamation::class)->findAll();

        $reclamations = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (reclamations)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            4 // Nombre de résultats par page
        );

        return $this->render('reclamation_controller_user/index.html.twig', [
            'reclamations' => $reclamations,
        ]);
    }


    /**
 * @Route("/newUser", name="reclamation_new_User", methods={"GET","POST"})

     */
    public function new(Request $request)
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $image=$request->files->get('reclamation')['screenshot'];
            $uploads_directory=$this->getParameter('kernel.root_dir'). '/../public/img';
            $filename=md5(uniqid()) . '.' . $image->guessExtension();
            $image->move(
                $uploads_directory,
                $filename
            );

            $reclamation->setScreenshot($filename);
            $reclamation->setStatut("en attente");
            $d = new \DateTime('now');
            $reclamation->setDateCreation($d);

            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();
            $this->addFlash('info', 'réclamation ajoutée avec succés');

            return $this->redirectToRoute('reclamation_controller_user_index');
        }

        return $this->render('reclamation_controller_user/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idReclamation}", name="reclamation_show_user", methods={"GET" ,"POST"})
     */
    public function show(Reclamation $reclamation , Request $request): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reclamation_controller_user');
        }
        return $this->render('reclamation_controller_user/show.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idReclamation}/edit", name="reclamation_edit_User", methods={"GET","POST"})
     */
    public function edit(Request $request, Reclamation $reclamation): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image=$request->files->get('reclamation')['screenshot'];
            $uploads_directory=$this->getParameter('kernel.root_dir'). '/../public/img';
            $filename=md5(uniqid()) . '.' . $image->guessExtension();
            $image->move(
                $uploads_directory,
                $filename
            );

            $reclamation->setScreenshot($filename);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('info', 'réclamation modifée avec succés');

            return $this->redirectToRoute('reclamation_controller_user_index');
        }

        return $this->render('reclamation_controller_user/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/Supp/{idReclamation}", name="reclamation_delete_User")
     */
    public function delete(FlashyNotifier $flashy ,$idReclamation, ReclamationRepository $repository)
    {
        $reclamation=$repository->find($idReclamation);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($reclamation);
        $entityManager->flush();

        $this->addFlash('info', 'réclamation supprimée avec succés');
        return $this->redirectToRoute('reclamation_controller_user_index');
    }

}
