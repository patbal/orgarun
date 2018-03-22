<?php
/**
 * Created by PhpStorm.
 * User: patbal
 * Date: 22/03/2018
 * Time: 09:39
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class mainController extends AbstractController
{

    /**
     * @Route("/")
     */
    public function homepage()
    {
        return new Response('first but not last');
    }

    /**
     * @Route("tt/{slug}/")
     */
    public function testslug($slug)
    {
        return new Response('tu as tapé '.$slug.' dans la barre, hein ? C\'est la classe !);
    }


}