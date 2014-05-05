<?php
namespace Rogers\DataAnalyticsToolBundle\Classes\Authentication;

class Service
{   
    private $_userRepository;
    private $_hashService;
    private $_pathWhiteList = array(
        '/authentication',
        '/authentication/login',
        '/authentication/logout'
    );

    public function __construct(
        \Rogers\DataAnalyticsToolBundle\Classes\User\Repository $userRepository,
        \Rogers\DataAnalyticsToolBundle\Classes\Authentication\Hash\Service $hashService,
        \Rogers\DataAnalyticsToolBundle\Classes\Authentication\Session\Service $sessionService
    )
    {
        $this->_userRepository = $userRepository;
        $this->_hashService = $hashService;
        $this->_sessionService = $sessionService;
    }

    public function login(Array $options)
    {
        $out = false;

        $user = $this->_userRepository->getActiveUserByUsername($options['username']);

        if(!empty($user)) {
            $hash = $this->_hashService->getHash($options['password'], $user->getPasswordHash());
            if ($hash == $user->getPasswordHash()) {
                $response = $this->_sessionService->setUserId($user->getId());
                if ($response == true) {
                    $out = true;
                }
            } else {
                //set the session flash bang message
            }
        }
        
        return $out;
    }

    public function logout()
    {
        $this->_sessionService->deleteUserId();
        return;
    }

    public function isLoggedIn()
    {
        $out = false;

        $userId = $this->_sessionService->getUserId();
        if (!empty($userId)) {
            $out = true;
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