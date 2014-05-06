<?php
namespace Rogers\DataAnalyticsToolBundle\Classes\Authentication\Session;
use Symfony\Component\HttpFoundation\Cookie;

class Service
{
    private $_session;
    private $_userIdKey = 'userId';
    private $_daysUntilCookieExpires = 30;

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

            //set the return value
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

    public function setFlashMessage($key, $message)
    {
        $this->_session->getFlashBag()->set($key, $message);
        return;
    }

    public function getFlashMessage($key)
    {
        $out = array_pop($this->_session->getFlashBag()->get($key));
        return $out;
    }

    public function setCookie(
        \Symfony\Component\HttpFoundation\RedirectResponse $response,
        \Symfony\Component\HttpFoundation\Request $request,
        $userId
    )
    {
        $remember = $request->get('remember');
        
        if (!empty($remember)) {
            $expirationDate = date('Y-m-d', strtotime("+" . $this->_daysUntilCookieExpires . " days"));
            $response->headers->setCookie(new Cookie($this->_userIdKey, $userId, $expirationDate));
        }

        return $response;
    }

    public function deleteCookie(\Symfony\Component\HttpFoundation\RedirectResponse $response)
    {
        $response->headers->clearCookie($this->_userIdKey);
        return $response;
    }

    public function getUserIdFromCookie(\Symfony\Component\HttpFoundation\Request $request)
    {
        $userId = $request->cookies->get($this->_userIdKey);
        return $userId;
    }
}