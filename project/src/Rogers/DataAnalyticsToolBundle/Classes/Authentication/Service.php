<?php
namespace Rogers\DataAnalyticsToolBundle\Classes\Authentication;

class Service
{
    private $_userRepository;

    public function __construct(\Rogers\DataAnalyticsToolBundle\Classes\User\Repository $userRopository)
    {
        $this->_userRepository = $userRopository;
    }

    public function getUser()
    {
        $user = $this->_userRepository->getUser();
        return $user;
    }
}