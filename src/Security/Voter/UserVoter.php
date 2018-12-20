<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return $attribute == 'USER_EDIT'
            && $subject instanceof User;
    }

    protected function voteOnAttribute(
        $attribute,
        $subject,
        TokenInterface $token)
    {
        return $subject == $token->getUser();
    }
}
