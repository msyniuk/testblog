<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;




class PostController extends Controller
{

    /**
     * @Route("/post/{id}", name="post_show")
     */
    public function show(Post $post)
    {
        return $this->render('post/show.html.twig', ['post' => $post]);
    }

    /**
     * @Route("/all", name="all_posts")
     */
    public function showAll()
    {
        $repo = $this->getDoctrine()->getRepository(Post::class);

        $posts = $repo->findAll(['date' => 'ASC']);

        if (!$posts){
            return $this->createNotFoundException('Записей не найдено!');
        }

        return $this->render('post/list.html.twig', ['posts' => $posts]);
    }

    /**
     * @Route("/add", name="add_post")
     */
    public function addPost()
    {
        return $this->render('post/add_post.html.twig');
    }

    /**
     * @Route("/edit/{id}", name="edit_post")
     */
    public function editPost()
    {
        return $this->render('post/edit_post.html.twig');
    }

}