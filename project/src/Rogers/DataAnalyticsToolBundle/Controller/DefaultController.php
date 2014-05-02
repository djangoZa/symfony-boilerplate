<?php
namespace Rogers\DataAnalyticsToolBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerAware;

class DefaultController extends Controller
{
    public function indexAction()
    {
        echo 'default:index'; die();
    }
}
