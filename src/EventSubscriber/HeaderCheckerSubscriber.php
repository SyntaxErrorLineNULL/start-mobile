<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Controller\Api\BookHeaderInterface;
use HttpResponseException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class HeaderCheckerSubscriber implements EventSubscriberInterface
{
    const HEADER = 'X-API-User-Name';

    public function onKernelController(ControllerEvent $event): void
    {
        $controller = $event->getController();

        // when a controller class defines multiple action methods, the controller
        // is returned as [$controllerInstance, 'methodName']
        if (is_array($controller)) {
            $controller = $controller[0];
        }

        if ($controller instanceof BookHeaderInterface) {
            $header = $event->getRequest()->headers->has(self::HEADER);
            if (!$header) throw new HeaderExistsException('Header X-API-User-Name is not found', Response::HTTP_FORBIDDEN);

            $admin = $event->getRequest()->headers->get(self::HEADER);
            if ($admin !== 'admin') throw new HeaderExistsException('Header X-API-User-Name is not valid', Response::HTTP_FORBIDDEN);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController'
        ];
    }
}