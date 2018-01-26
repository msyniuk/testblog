<?php

namespace App\Controller;

use App\Service\Posts;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function show(Posts $posts)
    {
        return $this->render('default/index.html.twig',
            ['lastPosts' => $posts->getLastPosts()]);
    }

}