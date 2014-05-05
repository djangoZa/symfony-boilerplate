<?php
namespace Rogers\DataAnalyticsToolBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;

class AuthenticationController extends Controller
{
    public function indexAction()
    {
        return $this->render('RogersDataAnalyticsToolBundle:Authentication:index.html.php');
    }

    public function loginAction(Request $request)
    {
        $response = null;
        $authenticationService = $this->container->get('authentication.service');
        $isLoggedIn = $authenticationService->login(array(
            'username' => $request->get('username'), 
            'password' => $request->get('password')
        ));

        if ($isLoggedIn == true) {
            $response = $this->redirect($this->generateUrl('rogers_data_analytics_tool_dashboard_index'), 301);
        } else {
            $response = $this->redirect($this->generateUrl('rogers_data_analytics_tool_authentication_index'), 301);
        }

        return $response;
    }

    public function logoutAction()
    {
        $authenticationService = $this->container->get('authentication.service');
        $authenticationService->logout();
        $response = $this->redirect($this->generateUrl('rogers_data_analytics_tool_dashboard_index'), 301);
        return $response;
    }
}