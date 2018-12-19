<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;


class ArticleController extends AbstractController
{
    // LISTE DES DERNIERS ARTICLES
    /**
     * @Route("/article", name="article", methods={"GET"})
     * @param ArticleRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ArticleRepository $repository)
    {
        $articles = $repository->findLatest(10);

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articles,
        ]);
    }

    // FORMULAIRE DE CREATION D'ARTICLE

    /**
     * @Route("/admin/article", name="article_new", methods={"GET", "POST"})
     * @param EntityManagerInterface $manager
     * @param TranslatorInterface $translator
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(
        EntityManagerInterface $manager,
        TranslatorInterface $translator,
        Request $request
    )
    {
        $form = $this->createForm(ArticleType::class, new Article());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();

            $manager->persist($article);
            $manager->flush();
            $this->addFlash(
                'success',
                $translator->trans(
                    'flash.success.article_created',
                    ['%id%' => $article->getId()]
                )
            );

            return $this->redirectToRoute('article');
        }

        return $this->render('article/create.html.twig', [
            'controller_name' => 'ArticleController',
            'create_form' => $form->createView(),
        ]);
    }

    // VUE D'UN ARTICLE
    /**
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/article/{id}", name="article_show", methods={"GET"})
     */
    public function show(Article $article)
    {
        $form = $this->createForm(FormType::class, null, [
            'method' => 'DELETE',
            'action' => $this->generateUrl(
                'article_delete',
                ['id' => $article->getId()]
            )
        ]);

        return $this->render(
            'article/show.html.twig',
            ['article' => $article, 'delete_form' => $form->createView()]
        );
    }

    // FORMULAIRE D'EDITION D'UN ARTICLE
    /**
     * @Route("/admin/article/{id}/edit", name="article_edit", methods={"GET"})
     * @param Article $article
     * @param EntityManagerInterface $manager
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function edit(
        Article $article,
        EntityManagerInterface $manager,
        Request $request)
    {
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setLastUpdate(new \DateTime());
            $manager->flush();

            return $this->redirectToRoute(
                'article_show',
                ['id' => $article->getId()]
            );
        }

        return $this->render(
            'article/edit.html.twig',
            ['edit_form' => $form->createView()]
        );
    }

    // SUPPRESSION D'UN ARTICLE
    /**
     * @Route(
     *     "/article/{id}/delete",
     *     name="article_delete",
     *     methods={"DELETE"}
     * )
     * @param Article $article
     * @param EntityManagerInterface $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(
        Article $article,
        EntityManagerInterface $manager
    )
    {
        $manager->remove($article);
        $manager->flush();
        return $this->redirectToRoute('article');
    }

}
