<?php
namespace Rogers\DataAnalyticsToolBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerAware;

class HierarchyController extends Controller
{
    public function indexAction()
    {
        $node = array(
            'id' => 1,
            'text' => 'Node 1',
            'icon' => 'node',
            'state' => array(
                'opened' => true,
                'disabled' => false,
                'selected' => false
            ),
            'children' => array(),
            'li_attr' => array(),
            'a_attr' => array()
        );

        $data[] = $node;
        $data[] = $node;

        return $this->render('RogersDataAnalyticsToolBundle:Hierarchy:index.html.php', array(
            'data' => json_encode($data)
        ));
    }
}