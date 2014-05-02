<?php
namespace Rogers\DataAnalyticsToolBundle\Classes\Authentication;

class Service
{
    private $_userRepository;
    private $_pathWhiteList = array(
        '/authentication',
        '/authentication/login',
        '/authentication/logout'
    );

    public function __construct(\Rogers\DataAnalyticsToolBundle\Classes\User\Repository $userRopository)
    {
        $this->_userRepository = $userRopository;
    }

    public function getUser()
    {
        $user = $this->_userRepository->getUser();
        return $user;
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