<?php

namespace App\Controller;

use App\Entity\Benevole;
use App\Form\AddBenevoleType;
use App\Form\BenevoleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BenevolesController extends Controller
{
    /**
     * @Route("/benevoles", name="benevoles")
     */
    public function index()
    {
        // On récupère la query
        $listeBenevoles = $this->getDoctrine()
            ->getManager()
            ->getRepository('App:Benevole')
            ->ListeBenevoles()
        ;
        return $this->render('benevoles/index.html.twig', ['benevoles'=>$listeBenevoles]);
    }

    /**
     * @Route("/benevoles/add", name="addBenevole")
     */
    public function add_benevole(Request $request)
    {
        $benevole = new Benevole();
        $form = $this -> get('form.factory') ->create(AddBenevoleType::class, $benevole);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this -> getDoctrine() -> getManager();
            $em -> persist($benevole);
            $em -> flush();

            $request->getSession()->getFlashBag()->add('notice', 'Bénévole enregistré');

            return $this -> redirectToRoute('benevoles');
        }

        return $this -> render('benevoles/add.html.twig', [
            'benevole' => $benevole,
            'form' => $form -> createView()]);
    }

    /**
     * @Route("/benevoles/view/{id}", name="viewBenevole")
     */
    public function view_benevole(Benevole $benevole, $id, Request $request)
    {
        if (null === $benevole) {
        throw new NotFoundHttpException("Ce bénévole n'a pas été enregistré");
        }

        return $this->render('benevoles/view.html.twig', array('benevole' => $benevole));
    }

    /**
     * @Route("/benevoles/edit/{id}", name="editBenevole")
     */
    public function editBenevole(Benevole $benevole, $id, Request $request)
    {
        if (null === $benevole) {
            throw new NotFoundHttpException("Ce bénévole n'a pas été enregistré");
        }

        $form = $this -> get('form.factory') -> create(BenevoleType::class, $benevole);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this -> getDoctrine() -> getManager();
            $em -> persist($benevole);
            $em -> flush();

            $request->getSession()->getFlashBag()->add('notice', 'Bénévole modifié');

            return $this -> redirectToRoute('viewBenevole', ['id'=>$benevole->getId()]);
        }

        return $this -> render('benevoles/edit.html.twig', ['benevole' => $benevole, 'form' => $form -> createView()]);

    }

    /**
     * @Route("/benevoles/delete/{id}", name="deleteBenevole")
     */
    public function deleteBenevole(Benevole $benevole, $id, Request $request)
    {
        if (null === $benevole) {
            throw new NotFoundHttpException("Ce bénévole n'existe pas dans nos bases");
        }

        $em = $this->getDoctrine()->getManager();
        $em -> remove($benevole);
        $request->getSession()->getFlashBag()-> add('danger', $benevole->getPrenom().' '.$benevole->getPrenom().' a été retiré de la liste des bénévoles');
        $em -> flush();

    }

}



