<?php
/**
 * Created by PhpStorm.
 * User: patbal
 * Date: 25/03/2018
 * Time: 20:52
 */

namespace App\Controller;


use App\Entity\Postes;
use App\Form\PostesType;
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

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/postes/add", name="addPoste")
     */
    public function add_poste(Request $request)
    {
        $poste = new Postes();
        $form = $this -> get('form.factory') ->create(PostesType::class, $poste);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {

            $doublon = $this -> getDoctrine()->getManager()->getRepository('App:Postes')
                ->findOneBy(['nom'=> $poste->getNom()]);
            if ($doublon){

                $this -> addFlash('danger', 'Poste déjà enregistré ! ');

                return $this -> render('postes/add.html.twig', [
                    'poste' => $poste,
                    'form' => $form -> createView()]);
            }

            $em = $this -> getDoctrine() -> getManager();
            $em -> persist($poste);
            $em -> flush();

            $this->addFlash('notice', 'Poste enregistré');

            return $this -> redirectToRoute('postes');
        }

        return $this -> render('postes/add.html.twig', [
            'poste' => $poste,
            'form' => $form -> createView()]);
    }

    /**
     * @param Postes $poste
     * @param $id
     * @param Request $request
     * @return string|\Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/postes/edit/{id}", name="editPoste")
     */
    public function edit_poste(Postes $poste, $id, Request $request)
    {
        $form = $this -> get('form.factory') -> create(PostesType::class, $poste);

        if ($request->isMethod('POST') && $form -> handleRequest($request)->isValid())
        {
            $em = $this -> getDoctrine() -> getManager();
            $em -> persist($poste);
            $em -> flush();

            $this -> addFlash('notice', 'Poste modifié');
            return $this -> redirectToRoute('postes');
        }

        return $this -> render('postes/edit.html.twig', ['poste' => $poste, 'form' => $form->createView()]);
    }

}