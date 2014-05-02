<?php
namespace Rogers\DataAnalyticsToolBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerAware;

class DashboardController extends Controller
{
    public function indexAction()
    {
        return $this->render('RogersDataAnalyticsToolBundle:Dashboard:index.html.php');
    }
}
