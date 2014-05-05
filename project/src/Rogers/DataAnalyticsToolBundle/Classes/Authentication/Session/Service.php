<?php
namespace Rogers\DataAnalyticsToolBundle\Classes\Authentication\Session;

class Service
{
    private $_session;
    private $_userIdKey = 'userId';

    public function __construct(\Symfony\Component\HttpFoundation\Session\Session $session)
    {
        $this->_session = $session;
    }

    public function setUserId($userId)
    {
        $out = false;

        //save the user id to the session
        $this->_session->set($this->_userIdKey, $userId);
        
        //get the user id from the session
        $sessionUserId = $this->_session->get($this->_userIdKey);

        //confirm the user ids match
        if ($userId == $sessionUserId) {
            $out = true;
        }

        return $out;
    }

    public function getUserId()
    {
        $userId = $this->_session->get($this->_userIdKey);
        return $userId;
    }

    public function deleteUserId()
    {
        $this->_session->remove($this->_userIdKey);
        return;
    }
}