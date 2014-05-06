<?php
namespace Rogers\DataAnalyticsToolBundle\Classes\Authentication\Response;

class Entity
{
    private $_successful;
    private $_message;

    public function __construct(Array $options)
    {
        $this->_successful = $options['successful'];
        $this->_message = (!empty($options['message'])) ? $options['message'] : '';
    }

    public function isSuccessful()
    {
        return $this->_successful;
    }

    public function getMessage()
    {
        return $this->_message;
    }
}