<?php
namespace Rogers\DataAnalyticsToolBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerAware;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $authenticationService = $this->container->get('authentication.service');
        $user = $authenticationService->getUser();

        return $this->render('RogersDataAnalyticsToolBundle:Default:index.html.php', array(
            'user' => $user
        ));
    }
}
