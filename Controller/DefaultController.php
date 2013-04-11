<?php

namespace Ecc12\PRHomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

/**
 * Class DefaultController
 * @Cache(expires="tomorrow")
 */
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
     * @Route("/directory/{in_family_id}", name="directory", defaults={"in_family_id" = -1})
     * @Template()
     */
    public function directoryAction($in_family_id)
    {
        $dir = array();

        return array("directory" => $dir);
    }
}
