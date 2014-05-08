<?php
namespace Rogers\DataAnalyticsToolBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;

class AuthenticationController extends Controller
{
    public function indexAction()
    {
        $authenticationService = $this->container->get('authentication.session.service');
        return $this->render('RogersDataAnalyticsToolBundle:Authentication:index.html.php', array(
            'alert' => $authenticationService->getFlashMessage('alert'),
            'username' => $authenticationService->getFlashMessage('username'),
            'password' => $authenticationService->getFlashMessage('password'),
            'remember' => $authenticationService->getFlashMessage('remember')
        ));
    }

    public function loginAction(Request $request)
    {
        $authenticationService = $this->container->get('authentication.service');
        $authenticationResponse = $authenticationService->login(array(
            'username' => $request->get('username'), 
            'password' => $request->get('password'),
            'remember' => $request->get('remember')
        ));

        if ($authenticationResponse->isSuccessful() == true) {
            $response = $this->redirect('/', 301);
            $response = $authenticationService->setUserCookie($response, $request);
        } else {
            $response = $this->redirect('/authentication', 301);
        }

        return $response;
    }

    public function logoutAction()
    {
        $authenticationService = $this->container->get('authentication.service');
        $authenticationService->logout();

        $response = $this->redirect('/', 301);
        $response = $authenticationService->deleteCookie($response);

        return $response;
    }
}