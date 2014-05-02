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
        echo 'authentication:index'; die();
    }

    public function checkAction()
    {
        echo 'check'; die();
    }

    public function loginAction()
    {
        echo 'login'; die();
    }

    public function logoutAction()
    {
        echo 'logout'; die();
    }
}
