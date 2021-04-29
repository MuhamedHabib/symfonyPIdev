<?php

namespace App\Controller;

use App\Entity\Events;
use App\Repository\EventsRespository;
use App\Entity\Participation;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Form\ParticipationType;
use App\Repository\ParticipationRespository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/participation")
 */
class ParticipationController extends AbstractController
{
    /**
     * @Route("/", name="participation_index", methods={"GET"})
     */
    public function index(ParticipationRespository $participationRespository): Response
    {
        return $this->render('participation/index.html.twig', [
            'participations' => $participationRespository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="participation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $participation = new Participation();

        $form = $this->createForm(ParticipationType::class, $participation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($participation);
            $entityManager->flush();




            return $this->redirectToRoute('events_indexuser');

        }

        return $this->render('participation/new.html.twig', [
            'participation' => $participation,
            'form' => $form->createView(),



        ]);
    }

    /**
     * @Route("/{idParticipation}", name="participation_show", methods={"GET"})
     */
    public function show(Participation $participation): Response
    {
        return $this->render('participation/show.html.twig', [
            'participation' => $participation,

        ]);
    }


    /**
     * @Route("/{idParticipation}", name="participation_delete", methods={"POST"})
     */
    public function delete(Request $request, Participation $participation): Response
    {
        if ($this->isCsrfTokenValid('delete' . $participation->getIdParticipation(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($participation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('participation_index');
    }

    /**
     * @Route("Imprimer/{idParticipation}", name="Imprimer", methods={"GET","POST"})
     */
    public function Imprimer(Participation $participation,ParticipationRespository $participationRepository): Response
    {

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Roboto');
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);


        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('participation/pdf.html.twig', [
            'participations' => $participationRepository->findByIdParticipation($participation),
        ]);
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("Participation.imprimer", [
            "Attachment" => true
        ]);
    }



}
