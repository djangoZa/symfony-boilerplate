<?php
namespace Rogers\DataAnalyticsToolBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerAware;

class AuthenticationController extends Controller
{
    /*public function indexAction()
    {
        $authenticationService = $this->container->get('authentication.service');
        $user = $authenticationService->getUser();

        return $this->render('RogersDataAnalyticsToolBundle:Authentication:index.html.php', array(
            'user' => $user
        ));
    }*/

    public function indexAction()
    {
        return $this->render('RogersDataAnalyticsToolBundle:Authentication:index.html.php');
    }

    public function loginAction()
    {
        return $this->render('RogersDataAnalyticsToolBundle:Authentication:login.html.php');
    }

    public function logoutAction()
    {
        return $this->render('RogersDataAnalyticsToolBundle:Authentication:logout.html.php');
    }
}
