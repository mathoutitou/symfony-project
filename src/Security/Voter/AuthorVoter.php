<?php

namespace App\Security\Voter;

use App\Entity\Author;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthorVoter extends Voter
{
    protected function supports($attribute, $subject)
    {

        return $attribute == 'ARTICLE_DELETE'
            && $subject instanceof Author;
    }

    protected function voteOnAttribute(
        $attribute,
        $subject,
        TokenInterface $token)
    {
        return $token->getUser() == $subject->getUser();

    }
}
