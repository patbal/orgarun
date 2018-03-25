<?php
/**
 * Created by PhpStorm.
 * User: patbal
 * Date: 25/03/2018
 * Time: 20:52
 */

namespace App\Controller;


use App\Entity\Postes;
use http\Env\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostesController extends AbstractController
{

    /**
     * @Route("/postes", name="postes")
     */

    public function index()
    {
        $listePostes = $this -> getDoctrine() -> getManager()-> getRepository('App:Postes')-> listePostes();

        return $this -> render('postes/index.html.twig', ['listePostes'=>$listePostes]);
    }

    /**
     * @Route("/postes/view/{id}", name="viewPoste")
     */
    public function viewPoste(Postes $poste, $id, Request $request)
    {
        if (null === $poste) {
            throw new NotFoundHttpException("Ce poste n'existe pas");
        }
        return $this->render('postes/view.html.twig', ['poste'=>$poste]);
    }

}