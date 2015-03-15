<?php

namespace AppBundle\Manager;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Post;

class PostManager
{
    /**
     * Doctrine entity manager for database interaction
     * @var EntityManager
     */
    protected $em;

    /**
     * Entity-specific repo
     * @var EntityRepository
     */
    protected $repo;

    /**
     * The Class Name for our entity
     * @var string
     */
    protected $class;

    public function __construct(EntityManager $em, $class)
    {
        $this->em = $em;
        $this->class = $class;
        $this->repo = $em->getRepository($class);
    }

    /**
     * @return Post
     */
    public function createPost()
    {
        $class = $this->getClass();
        $post = new $class();

        return $post;
    }

    public function savePost(Post $post)
    {
        $this->em->persist($post);
        $this->em->flush();
    }

    public function updatePost(Post $post)
    {
        $this->em->flush();
    }

    public function addCommentToPost(Post $post, Comment $comment)
    {

    }

    public function findLastPosts()
    {
        $posts = $this->repo->findAll();

        return $posts;
    }

    private function getClass()
    {
        return $this->class;
    }
}
