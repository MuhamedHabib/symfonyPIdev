<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageAdminType;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Vonage\Client\Credentials\Basic;


/**
 * @Route("/message")
 */
class MessageController extends AbstractController
{
    /**
     * @Route("/", name="message_index", methods={"GET"})
     */
    public function index(MessageRepository $messageRepository,Request $request, PaginatorInterface $paginator):Response
    {
        $donnees = $this->getDoctrine()->getRepository(Message::class)->findAll();

        $messages = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            4 // Nombre de résultats par page
        );

        return $this->render('message/index.html.twig', [
            'messages' => $messages,
        ]);
    }

    /**
     * @Route("/{idMessage}", name="message_show", methods={"GET", "POST"})
     */
    public function show(Message $message , Request $request): Response
    {
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('message_index');
        }
        return $this->render('message/show.html.twig', [
            'message' => $message,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/Supp/{idMessage}", name="message_delete")
     */
    public function delete($idMessage,MessageRepository $repository)
    {
        $message=$repository->find($idMessage);
        $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($message);
            $entityManager->flush();


        return $this->redirectToRoute('message_index');
    }

    /**
     * @Route("/Valider/{idMessage}", name="valider_mes" , methods={"GET","POST"})
     */
    public function valider($idMessage, MessageRepository $repository)
    {
        $message = $repository->find($idMessage);
        $message->setStatut("validée");
        $d = new \DateTime('now');
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        return $this->redirectToRoute('reclamation_index');


    }
    /**
     * @Route("/{idMessage}/edit", name="message_reply", methods={"GET","POST"})
     */
    public function edit(Request $request, Message $message): Response
    {
        $form = $this->createForm(MessageAdminType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();
            $basic  = new Basic("08c54861", "l3zDZzE9575h1Lb0");
            $client = new \Vonage\Client($basic);

            $response = $client->sms()->send(
                new \Vonage\SMS\Message\SMS("21624539943", HelpDesk, 'Votre réponse a été envoyée avec succés.')
            );

            $message = $response->current();

            if ($message->getStatus() == 0) {
                echo "The message was sent successfully\n";
            } else {
                echo "The message failed with status: " . $message->getStatus() . "\n";
            }
            return $this->redirectToRoute('message_index');

        }

        return $this->render('message/edit.html.twig', [
            'message' => $message,
            'form' => $form->createView(),
        ]);
    }
}
