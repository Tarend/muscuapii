<?php

namespace App\Controller;

use App\Entity\Atelier;
use App\Entity\Post;
use App\Form\AtelierType;
use App\Repository\CommentaireAtelierRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use App\Repository\BoissonRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/commentaires_atelier/ateliers/{id}", name="commentaires_atelier", methods={"GET"})
     */
    public function commentaires_atelier(CommentaireAtelierRepository $commentaireAtelierRepository, $id)
    {
        return $response = $this->json($commentaireAtelierRepository->findBy(['atelier' => $id]), 200, []);
    }
    /**
     * @Route("/apip/activites_sequence/{id}", name="activites_sequence", methods={"GET"})
     */
    public function activites_sequence(ActiviteSequenceTheoriqueRepository $activitesequencetheoriqueRepository, $id)
    {
        return $response = $this->json($activitesequencetheoriqueRepository->findBy(['idsequencetheorique' => $id]), 200, []);
    }

    /**
     * @Route("/apip/activite_sequence/{activite}/{sequence}", name="activite_sequence", methods={"GET"})
     */
    public function activite_sequence(ActiviteSequenceTheoriqueRepository $activitesequencetheoriqueRepository, $activite, $sequence)
    {
        return $response = $this->json($activitesequencetheoriqueRepository->findOneBy(['id' => $activite, 'idsequencetheorique' => $sequence]), 200, []);
    }



}
