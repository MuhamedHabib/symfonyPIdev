<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\File;
use App\Entity\Myformation;
use App\Form\ContactType;
use App\Form\FormationType;
use App\Repository\MyformationRepository;
use App\Service\FormationService;
use Knp\Component\Pager\PaginatorInterface;
use phpDocumentor\Reflection\DocBlock\Serializer;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class FormationController extends AbstractController
{


    /**
     * @var FormationService
     */
    private $formationService;


    /**
     * BlogController constructor.
     * @param FormationService $formationService
     */
    public function __construct(FormationService $formationService)
    {

        $this->formationService = $formationService;
    }
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
          #  var_dump($file);
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            // moves the file to the directory where brochures are stored
            try {
                $file->move(
                    $this->getParameter('brochures_directory'), $fileName);
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            $brochureFiles = $form->get('brochure')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFiles) {
                // On boucle sur les images
                foreach ($brochureFiles as $brochureFile) {
                    $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessExtension();

                    // Move the file to the directory where brochures are stored
                    try {
                        $brochureFile->move(
                            $this->getParameter('file_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }

                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents

                    $file = new File();
                    $file->setMyFile($newFilename);
                    $file->setFile(($request->get("typefile")));
                    $file->setDateCreation(new \DateTime());
                    $formation->addBrochureFilename($file);
                }
            }
            $formation->setDateCreation(new \DateTime());
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
     * @Route("/user/formation/show", name="show")
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function showFormation(Request $request, PaginatorInterface $paginator) // Nous ajoutons les paramètres requis
    {
        // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
        $donnees = $this->getDoctrine()->getRepository(Myformation::class)->findBy([],['dateCreation' => 'desc']);

        $formations = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            3 // Nombre de résultats par page
        );

        return $this->render('user/list.html.twig', [
            'formations' => $formations,
        ]);
    }



    /**
     * @Route("/formation/edit/{id}", name="edit_formation")
     * @param $id
     * @param MyformationRepository $repository
     * @param Request $request
     * @return RedirectResponse|Response
     */
    function editFormation($id,MyformationRepository$repository,Request $request){

        $formation=$repository->find($id);
        $editform=$this->createForm(FormationType::class,$formation);
        $editform->handleRequest($request);
        if ($editform->isSubmitted() && $editform->isValid()){
            $em=$this->getDoctrine()->getManager();
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
            /** @var UploadedFile $brochureFiles */
            $brochureFiles = $editform->get('brochure')->getData();

            if ($brochureFiles) {
                // On boucle sur les images
                foreach ($brochureFiles as $brochureFile) {
                    $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessExtension();

                    // Move the file to the directory where brochures are stored
                    try {
                        $brochureFile->move(
                            $this->getParameter('file_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }

                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents

                    $file = new File();
                    $file->setMyFile($newFilename);
                   // $file->setFile("esprit");
                    $file->setFile(($request->get("typefile")));
                    $file->setDateCreation(new \DateTime());
                    $formation->addBrochureFilename($file);
                }
            }
            $formation->setDateCreation(new \DateTime());
            $formation->setImage($fileName);
            $em->persist($formation);
            $em->flush();


            return $this->redirectToRoute("list_formation");
        }
        return $this->render('formation/edit.html.twig',
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
        $files =$em->getRepository(File::class)->findBy(['myformation'=>$formation]);
        foreach ($files as $file){
            // On récupère le nom de l'image
            $nom = $file->getMyFile();
            // On supprime le fichier
           //$file->remove(
           //$this->getParameter('brochures_directory').'/'.$nom);
            unlink($this->getParameter('file_directory').'/'.$nom);
            $em->remove($file);
            $em->flush();
        }
        $em->remove($formation);
        $em->flush();
        return $this->redirectToRoute('list_formation');
    }


    /**
     * @param Request $request
     * @param MyformationRepository $repository
     * @return Response
     * @Route ("/rechercheM",name="rechercheM")
     */

    function Recherche(Request $request,MyformationRepository $repository){
        $data=$request->get('search');

        $formation=$repository->findBy(['libelle'=>$data]);
        return $this->render('formation/list.html.twig',[
            'formations'=>$formation
        ]);

    }


    /**
     * @Route("/formation/detail/{id}", name="detail")
     * @param $id
     * @return Response
     */
    public function formationDetail ($id)
    {
        $em = $this->getDoctrine()->getManager();
        $formation = $em->getRepository(Myformation::class)->findOneBy(['id'=>$id]);

        return $this->render('formation/detailFormation.html.twig', [
            'formation' => $formation
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @param Swift_Mailer $mailer
     * @return Response
     */
    public function email(Request $request , Swift_Mailer $mailer)
    {

        $contact= new Contact();
        $form = $this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);
        # check if form is submitted

        if($form->isSubmitted() &&  $form->isValid()) {
            $name = $form['name']->getData();
            $email = $form['email']->getData();
            $message = $form['message']->getData();

            # set form data

            $contact->setName($name);
            $contact->setEmail($email);
            $contact->setMessage($message);

            # finally add data in database

            $sn = $this->getDoctrine()->getManager();
            $sn->persist($contact);
            $sn->flush();
            $subj = (new \Swift_Message('Proposition Formation'))
                ->setFrom($email)
                ->setTo('mohamedhabib.khattat@esprit.tn')
                ->setBody($this->renderView('emails/sendEmail.html.twig',array('name' => $name, 'message' => $message)),'text/html');
            $mailer->send($subj);

        }

        return $this->render('emails/contact.html.twig',['emailForm' => $form->createView()]);
    }

}
