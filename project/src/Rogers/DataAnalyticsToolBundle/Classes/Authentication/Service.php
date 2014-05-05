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
        \Rogers\DataAnalyticsToolBundle\Classes\Authentication\Hash\Service $hashService
    )
    {
        $this->_userRepository = $userRepository;
        $this->_hashService = $hashService;
    }

    public function login(Array $options)
    {
        $out = false;

        $user = $this->_userRepository->getActiveUserByUsername($options['username']);
        $hash = $this->_hashService->getHash($options['password'], $user->getPasswordHash());

        if ($hash == $user->getPasswordHash()) {
            //set the user session
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