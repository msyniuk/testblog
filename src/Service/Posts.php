<?php

namespace App\Service;


use App\Entity\Post;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class Posts
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }


    /**
     * @return Post[]|array
     */
    public function getLastPosts()
    {
        $repo = $this->em->getRepository(Post::class);

        return $repo->findBy([],['date_post' => 'DESC'], 3);
    }
}