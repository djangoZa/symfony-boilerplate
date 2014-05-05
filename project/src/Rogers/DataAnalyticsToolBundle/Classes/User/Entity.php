<?php
namespace Rogers\DataAnalyticsToolBundle\Classes\User;

class Entity
{
    private $_passwordHash;

    public function __construct(Array $options)
    {
        $this->_passwordHash = $options['passwordHash'];
    }

    public function getPasswordHash()
    {
        return $this->_passwordHash;
    }
}