<?php
namespace Rogers\DataAnalyticsToolBundle\Classes\User;

class Repository
{
    private $_gateway;

    public function __construct(Gateway $gateway)
    {
        $this->_gateway = $gateway;
    }

    public function getActiveUserByUsername($username)
    {
        $out = null;
        $row = $this->_gateway->getUser(array(
            'username' => $username,
            'status' => 1
        ));

        if (!empty($row)) {
            $out = new \Rogers\DataAnalyticsToolBundle\Classes\User\Entity($row);
        }

        return $out;
    }
}