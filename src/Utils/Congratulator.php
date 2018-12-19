<?php

namespace App\Utils;


use App\Repository\AuthorRepository;
use Symfony\Contracts\Translation\TranslatorInterface;

class Congratulator
{
    const LEVELS = ['moderate', 'extra', 'crazy'];

    private $authorRepository;

    private $translator;

    public function __construct(
        AuthorRepository $authorRepository,
        TranslatorInterface $translator
    )
    {
        $this->authorRepository = $authorRepository;
        $this->translator = $translator;
    }

    public function thankSomeone()
    {
        $level = self::LEVELS[array_rand(self::LEVELS)];
        $allAuthors = $this->authorRepository->findAll();
        $authorName = $allAuthors[array_rand($allAuthors)]->getName();

        return $this->translator->trans(
            "congratulator.$level",
            ['%name%' => $authorName]
        );
    }


}