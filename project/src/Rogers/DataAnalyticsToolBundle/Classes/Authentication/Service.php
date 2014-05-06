<?php
namespace Rogers\DataAnalyticsToolBundle\Classes\Authentication;

class Service
{   
    private $_userRepository;
    private $_responseRepository;
    private $_hashService;
    private $_pathWhiteList = array(
        '/authentication',
        '/authentication/login',
        '/authentication/logout'
    );

    public function __construct (
        \Rogers\DataAnalyticsToolBundle\Classes\User\Repository $userRepository,
        \Rogers\DataAnalyticsToolBundle\Classes\Authentication\Response\Repository $responseRepository,
        \Rogers\DataAnalyticsToolBundle\Classes\Authentication\Hash\Service $hashService,
        \Rogers\DataAnalyticsToolBundle\Classes\Authentication\Session\Service $sessionService
    )
    {
        $this->_userRepository = $userRepository;
        $this->_responseRepository = $responseRepository;
        $this->_hashService = $hashService;
        $this->_sessionService = $sessionService;
    }

    public function login(Array $options)
    {
        //Set the default response
        $out = $this->_responseRepository->makeResponse(array(
            'successful' => false,
            'message' => 'Invalid authentication details have been supplied'
        ));

        //Try and log the user in
        $user = $this->_userRepository->getActiveUserByUsername($options['username']);
        if (!empty($user)) {
            $hash = $this->_hashService->getHash($options['password'], $user->getPasswordHash());
            if ($hash == $user->getPasswordHash()) {
                $remember = (!empty($options['remember'])) ? true : false;
                $response = $this->_sessionService->setUserId($user->getId());
                if ($response == true) {
                    $out = $this->_responseRepository->makeResponse(array(
                        'successful' => true
                    ));
                }
            }
        }

        //Set the values we want to pass back to the UI
        $this->_sessionService->setFlashMessage('alert', $out->getMessage());
        $this->_sessionService->setFlashMessage('username', $options['username']);
        $this->_sessionService->setFlashMessage('password', $options['password']);
        $this->_sessionService->setFlashMessage('remember', $options['remember']);

        return $out;
    }

    public function logout()
    {
        $this->_sessionService->deleteUserId();
        return;
    }

    public function setCookie(
        \Symfony\Component\HttpFoundation\RedirectResponse $response,
        \Symfony\Component\HttpFoundation\Request $request
    )
    {
        $userId = $this->_sessionService->getUserId();
        $response = $this->_sessionService->setCookie($response, $request, $userId);
        return $response;
    }

    public function deleteCookie(\Symfony\Component\HttpFoundation\RedirectResponse $response)
    {
        $response = $this->_sessionService->deleteCookie($response);
        return $response;
    }

    public function isLoggedIn(\Symfony\Component\HttpFoundation\Request $request)
    {
        $out = false;

        $sessionUserId = $this->_sessionService->getUserId();
        if (!empty($sessionUserId)) {
            $out = true;
        } else {
            //check the cookie
            $cookieUserId = $this->_sessionService->getUserIdFromCookie($request);
            if (!empty($cookieUserId)) {
                //set the user id from the cookie into the user id in the session
                $response = $this->_sessionService->setUserId($cookieUserId);
                if ($response == true) {
                    $out = true;
                }
            }
        }

        return $out;
    }

    public function isWhiteListedRequest(\Symfony\Component\HttpFoundation\Request $request)
    {
        $out = false;
        $path = $request->getPathInfo();

        if (in_array($path, $this->_pathWhiteList)) {
            $out = true;
        }

        return $out;
    }
}