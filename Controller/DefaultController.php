<?php

namespace Ecc12\PRHomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/hello/{in_name}", name = "hello", defaults={"in_name" = "Friend"})
     * @Template()
     */
    public function helloAction($in_name)
    {
        return array('name' => $in_name);
    }

    /**
     * @Route("/directory/{family_id}", name="directory", defaults={"family_id" = -1})
     * @Template()
     */
    public function directoryAction($family_id)
    {
        return array("directory_text" => print_r(simplexml_load_file(
            $this->get('kernel')->locateResource("@Ecc12PRHomeBundle/Resources/private/directory.xml")),
            true));
    }
}
