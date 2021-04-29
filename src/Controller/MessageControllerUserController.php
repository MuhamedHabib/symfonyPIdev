<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\Message1Type;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Vonage\Client\Credentials\Basic;



/**
 * @Route("/message/controller/user")
 */
class MessageControllerUserController extends AbstractController
{
    /**
     * @Route("/", name="message_controller_user_index", methods={"GET"})
     */
    public function index(MessageRepository $messageRepository,Request $request, PaginatorInterface $paginator):Response
    {
        $donnees = $this->getDoctrine()->getRepository(Message::class)->findAll();

        $messages = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            4 // Nombre de résultats par page
        );

        return $this->render('message_controller_user/index.html.twig', [
            'messages' => $messages,
        ]);
    }
    /**
     * @Route("/newUser", name="message_controller_user_new", methods={"GET","POST"})
     */
    public function new(Request $request)
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setReponse("aucune");
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush();
            $this->addFlash('info', 'message envoyé avec succés');

            return $this->redirectToRoute('message_controller_user_index');
        }


        return $this->render('message_controller_user/new.html.twig', [
            'message' => $message,
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/{idMessage}", name="message_controller_user_show", methods={"GET"})
     */
    public function show(Message $message , Request $request): Response
    {
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('message_controller_user_index');
        }
        return $this->render('message_controller_user/show.html.twig', [
            'message' => $message,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/Supp/{idMessage}", name="message_controller_user_delete")
     */
    public function delete( $idMessage,MessageRepository $repository)
    {
        $message=$repository->find($idMessage);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($message);
            $entityManager->flush();
        $this->addFlash('info', 'message supprimé avec succés');

        return $this->redirectToRoute('message_controller_user_index');
    }
}
