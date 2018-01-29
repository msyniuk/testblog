<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Form\CommentType;
use App\Form\PostType;
use App\Service\Posts;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;



class PostController extends Controller
{

    /**
     * @Route("/post/{id}", name="post_show")
     */
    public function show(Post $post, Request $request, EntityManagerInterface $em)
    {
        $comments = $post->getComments();
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->addComment($comment);
            $em->persist($comment);
            $em->flush();
            $id = $post->getId();
            $this->addFlash('info', 'Комментарий добавлен!');

            return $this->redirectToRoute('post_show',
                ['id' => $id]);
        }

        return $this->render('post/show.html.twig', [
            'form' => $form->createView(),
            'post' => $post,
            'comments' => $comments,

        ]);

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
    public function addPost(Request $request, EntityManagerInterface $em)
    {

        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$feedback = $form->getData(); если форма не связана с сущностью
            $em->persist($post);
            $em->flush();
            $id = $post->getId();
            $this->addFlash('info', 'Пост добавлен!');

            return $this->redirectToRoute('post_show',
                ['id' => $id]);
        }

        return $this->render('post/add_post.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit_post")
     */
    public function editPost(Post $post, Request $request, EntityManagerInterface $em)
    {

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            //$em->persist($post);
            $em->flush();
            $id = $post->getId();
            $this->addFlash('info', 'Изменения сохранены!');

            return $this->redirectToRoute('post_show',
                ['id' => $id]);
        }

        return $this->render('post/edit_post.html.twig', [
            'form' => $form->createView(),
            'post' => $post,
        ]);

    }

    /**
     * @Route("/del/{id}", name="del_post")
     */
    public function deletePost(Post $post, Posts $posts)
    {
        $posts->removePost($post);
        $this->addFlash('warning', 'Пост уcпешно удален!');
        return $this->redirectToRoute('all_posts');

    }

}