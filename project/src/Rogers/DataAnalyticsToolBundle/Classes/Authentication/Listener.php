<?php
namespace Rogers\DataAnalyticsToolBundle\Classes\Authentication;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpFoundation\RedirectResponse;
class Listener
{
    protected $_authenticationService;

    public function __construct(\Rogers\DataAnalyticsToolBundle\Classes\Authentication\Service $authenticationService)
    {
        $this->_authenticationService = $authenticationService;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (HttpKernel::MASTER_REQUEST == $event->getRequestType()) {
            $this->_initSecurityCheck($event);
        }
        return;
    }

    public function _initSecurityCheck(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $isWhiteListedRequest = $this->_authenticationService->isWhiteListedRequest($request);

        if ($isWhiteListedRequest == false) {
            $response = new RedirectResponse("/authentication");
            $event->setResponse($response);
        }
    }
}