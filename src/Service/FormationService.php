<?php


namespace App\Service;



use App\Repository\MyformationRepository;
use Doctrine\ORM\EntityManagerInterface;

class FormationService
{
    CONST LIMIT=3;
    /**
     * @var MyformationRepository
     */
    private $formationRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;




    /**
     * homeService constructor.
     * @param EntityManagerInterface $entityManager
     * @param MyformationRepository $formationRepository
     */
    public function __construct(EntityManagerInterface $entityManager,  MyformationRepository $formationRepository)
    {
        $this->entityManager = $entityManager;
        $this->formationRepository = $formationRepository;
    }


    public function getBlogs(int $offset ){
        return $this->formationRepository->findBy([],['dateCreation' => 'DESC'],self::LIMIT,$offset);
    }


    public function getLast3Blogs(){
        return $this->formationRepository->findBy([],['dateCreation' => 'desc'],3);
    }


}
