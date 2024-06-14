<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Exception\IsVerifiedAuthenticationException;
use Symfony\Component\Security\Http\Event\CheckPassportEvent;

class LoginSubscriber implements EventSubscriberInterface
{
    public function onCheckPassportEvent(CheckPassportEvent $event): void
    {
        $user = $event->getPassport()->getUser();

        if(!$user->isVerified()) {
            throw new IsVerifiedAuthenticationException();
        }

    }

    public static function getSubscribedEvents(): array
    {
        return [
            CheckPassportEvent::class => ['onCheckPassportEvent', -10],
        ];
    }
}
