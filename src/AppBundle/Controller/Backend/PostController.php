<?php

namespace AppBundle\Controller\Backend;

use AppBundle\Entity\Post;
use AppBundle\Form\Type\PostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/posts")
 */
class PostController extends Controller
{
    /**
     * @Route("/", name="posts")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Post');
        $posts      = $repository->findAll();

        return $this->render(
            'backend/post/index.html.twig',
            ['posts' => $posts]
        );

    }

    /**
     * @Route("/new", name="post_new")
     */
    public function newAction(Request $request)
    {
        $post_manager = $this->container->get('app.manager.post');
        $post = $post_manager->createPost();
        $form = $this->createForm(new PostType(), $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post_manager->savePost($post);
        }

        return $this->render(
            'backend/post/new.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * @Route("/{id}/edit", name="post_edit")
     */
    public function editAction(Request $request, Post $post)
    {

        $form = $this->createForm(new PostType(), $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post_manager = $this->container->get('app.manager.post');
            $post_manager->updatePost($post);
        }

        return $this->render(
            'backend/post/edit.html.twig',
            ['form' => $form->createView()]
        );
    }
}
