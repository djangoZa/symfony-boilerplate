<?php
namespace Rogers\DataAnalyticsToolBundle\Classes\Authentication\Response;

class Repository
{
    public function makeResponse(Array $options)
    {
        $out = new \Rogers\DataAnalyticsToolBundle\Classes\Authentication\Response\Entity($options);
        return $out;
    }
}