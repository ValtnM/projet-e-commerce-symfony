<?php

namespace Symfony\Component\Security\Core\Exception;

class IsVerifiedAuthenticationException extends AuthenticationException
{
   
    public function getMessageKey(): string
    {
        return 'Compte non vérifié';
    }

   
}
