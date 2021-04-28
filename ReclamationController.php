<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Services\Mailer;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use DateTime;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\File;
use Knp\Component\Pager\PaginatorInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Vonage\Client\Credentials\Basic;
use Symfony\Contracts\Translation\TranslatorInterface;



/**
 * @Route("/reclamation")
 */
class ReclamationController extends AbstractController
{
    /**
     * @Route("/", name="reclamation_index", methods={"GET"})
     */
    public function index(ReclamationRepository $reclamationRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $donnees = $reclamationRepository->findAll();

        foreach ($donnees as $r){
            if($r->getStatut() == "en attente") {
                $datetime = new DateTime(date("Y-m-d H:i:s"));
                $date_r = $r->getDateCreation()->format('U');
                if (((($datetime->format('U')) - $date_r) / (3600 * 24)) > 1) {
                    $r->setStatut("En cours");
                    $this->getDoctrine()->getManager()->flush();
                }
            }
        }
        //$liste=$this->verif($reclamationRepository,$donnees);

        $list1=$reclamationRepository->calcul("validée");
        $total1=0;
        foreach ($list1 as $row){
            $total1++;
        }
        $list2=$reclamationRepository->calcul("en cours");
        $total2=0;
        foreach ($list2 as $row){
            $total2++;
        }
        $list3=$reclamationRepository->calcul("en attente");
        $total3=0;
        foreach ($list3 as $row){
            $total3++;
        }

        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['Task', 'Hours per Day'],
                ['validée',     $total1],
                ['en cours',    $total2],
                ['en attente',    $total3]
            ]
        );
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);


        $reclamations = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            4 // Nombre de résultats par page
        );

        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $reclamations,
            'piechart' => $pieChart,

        ]);
    }


    /**
     * @Route("/new", name="reclamation_new", methods={"GET","POST"})
     */
    public function new(Request $request )
    {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $image = $request->files->get('reclamation')['screenshot'];
            $uploads_directory = $this->getParameter('kernel.root_dir') . '/../public/img';
            $filename = md5(uniqid()) . '.' . $image->guessExtension();
            $image->move(
                $uploads_directory,
                $filename
            );

            $reclamation->setScreenshot($filename);
            $reclamation->setStatut("en attente");
            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();


            return $this->redirectToRoute('reclamation_show');
        }

        return $this->render('reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idReclamation}", name="reclamation_show", methods={"GET","POST"})
     */
    public function show(Reclamation $reclamation, Request $request ): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('reclamation_index');
        }
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/Valider/{idReclamation}", name="valider_rec" , methods={"GET","POST"})
     */
    public function valider($idReclamation, ReclamationRepository $repository, \Swift_Mailer $mailer)
    {
        $reclamation = $repository->find($idReclamation);
        $reclamation->setStatut("validée");
        $d = new \DateTime('now');
        $reclamation->setDateValidation($d);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        $mail = (new \Swift_Message('Votre réclamation a été traité !'))
            // On attribue l'expéditeur
            ->setFrom('Inovvat@gmail.com')
            // On attribue le destinataire
           // ->setTo($user->getEmail())
            ->setTo("mariem.lachheb@esprit.tn")
            // On crée le texte avec la vue
            ->setBody(
                $this->renderView(
                    'emails/email.html.twig'
                ),
                'text/html'
            )
        ;
        $mailer->send($mail);

      /* $basic  = new Basic("08c54861", "l3zDZzE9575h1Lb0");
        $client = new \Vonage\Client($basic);

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("21624539943", HelpDesk, 'Votre réclamation a été validée avec succés.Vous pouvez consulter votre compte pour vérifier.')
        );

        $message = $response->current();

        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }*/
        return $this->redirectToRoute('reclamation_index');
        //return $this->render('reclamation/show.html.twig');


    }

    /**
     * @Route("/Supp/{idReclamation}", name="reclamation_delete")
     */
    public function delete($idReclamation, ReclamationRepository $repository)
    {
        $reclamation = $repository->find($idReclamation);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($reclamation);
        $entityManager->flush();


        return $this->redirectToRoute('reclamation_index');
    }
    
    /**
     * @Route("/test", name="test_rec")
     */
    public function statAction()
    {
        $pieChart = new PieChart();

        $pieChart->getData()->setArrayToDataTable( array(
            ['type',     30],
            ['statut',      70],
        ));

        $pieChart->getOptions()->setTitle('You still in work');
        $pieChart->getOptions()->setHeight(400);
        $pieChart->getOptions()->setWidth(400);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#07600');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(25);


        return $this->render(':reclamation:chart.html.twig', array(
                'piechart' => $pieChart,
            )

        );
    }


    /**
     * @Route("/occurence", name="occurence_rec" )
     */
    public function occurence(): Response
    {   $repository = $this->getDoctrine()->getRepository(Reclamation::class);
        $Reclamation = $repository->findAll();
        $em = $this->getDoctrine()->getManager();
        $Contenu = 0;
        $ServiceTechnique = 0;
        $percV = 0;
        $percNV = 0;
        $NBrec = 0;
        foreach ($Reclamation as $reclamation) {
            $NBrec += 1;
            if ($reclamation->getType() == "Contenu")  :

                $Contenu += 1;
            elseif ($reclamation->getType() == "Service technique"):

                $ServiceTechnique += 1;
            else :
            endif;
        }
        $percV = number_format(($Contenu / $NBrec) * 100, 2);
        $percNV = number_format(($ServiceTechnique / $NBrec) * 100, 2);

        return new Response('percentage claims Validates : ' . $percV . ' %');
    }

        /*
            public function search(Request $request)
            {
                $em = $this->getDoctrine()->getManager();
                $requestString = $request->get('q');
                $reclamation =  $em->getRepository('reclamation')->findEntitiesByString($requestString);
                if(!$reclamation) {
                    $result['reclamation']['error'] = "reclamation Not found :( ";
                } else {
                    $result['reclamation'] = $this->getRealEntities($reclamation);
                }
                return new Response(json_encode($result));
            }

            /** @noinspection PhpUndefinedVariableInspection
            public function getRealEntities($reclamation){
                foreach ($reclamation as $reclamation){
                    $realEntities[$reclamation->getId()] = [$reclamation->getStatut(),$reclamation->getText()];

                }
                return $realEntities;
            }
        */


    }
