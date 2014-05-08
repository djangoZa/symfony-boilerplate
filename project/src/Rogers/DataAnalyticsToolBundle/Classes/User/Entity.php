<?php
namespace Rogers\DataAnalyticsToolBundle\Classes\User;

class Entity
{
    private $_id;
    private $_passwordHash;

    public function __construct(Array $options)
    {
        $this->_id = $options['userID'];
        $this->_passwordHash = $options['passwordHash'];
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getPasswordHash()
    {
        return $this->_passwordHash;
    }
}