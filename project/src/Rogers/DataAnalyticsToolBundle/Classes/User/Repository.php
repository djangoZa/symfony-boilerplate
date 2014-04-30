<?php
namespace Rogers\DataAnalyticsToolBundle\Classes\User;

class Repository
{
    public function getUser()
    {
        return new \Rogers\DataAnalyticsToolBundle\Classes\User\Entity();
    }
}