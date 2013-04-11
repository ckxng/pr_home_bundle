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

        $xml = simplexml_load_file(
            $this->get('kernel')->locateResource("@Ecc12PRHomeBundle/Resources/private/directory.xml"));
        $xml = json_decode(json_encode($xml),1)['directory'];
        $dir = array();

        foreach($xml as $row)
        {
            $family_id = $row['families_ID'];
            if(!array_key_exists($family_id, $dir)) {
                $dir[$family_id] = array(
                    '@id' => $family_id,
                    'name' => false,
                    'address_1' => false,
                    'address_2' => false,
                    'city' => false,
                    'state' => false,
                    'zipcode' => false,
                    'country' => false,
                    'email' => false,
                    'phone' => false,
                    'people' => array()
                );
                if(array_key_exists('family_name', $row)) {
                    $dir[$family_id]['name'] = $row['family_name'];
                }
                if(array_key_exists('address_1', $row)) {
                    $dir[$family_id]['address_1'] = $row['address_1'];
                }
                if(array_key_exists('address_2', $row)) {
                    $dir[$family_id]['address_2'] = $row['address_2'];
                }
                if(array_key_exists('city', $row)) {
                    $dir[$family_id]['city'] = $row['city'];
                }
                if(array_key_exists('state', $row)) {
                    $dir[$family_id]['state'] = $row['state'];
                }
                if(array_key_exists('zipcode', $row)) {
                    $dir[$family_id]['zipcode'] = $row['zipcode'];
                }
                if(array_key_exists('country', $row)) {
                    $dir[$family_id]['country'] = $row['country'];
                }
                if(array_key_exists('families_email', $row)) {
                    $dir[$family_id]['email'] = $row['families_email'];
                }
                if(array_key_exists('families_phone', $row)) {
                    $dir[$family_id]['phone'] = $row['families_phone'];
                }
            }
            $person_id = "$row[sort]_$row[first_name]$row[last_name]_$row[people_ID]";
            $dir[$family_id]['people'][$person_id] = array(
                '@id' => $person_id,
                'family_id' => $family_id,
                'first_name' => false,
                'last_name' => false,
                'type' => false,
                'relationship' => false,
                'phone' => false,
                'email' => false,
                'birthday' => false,
                'anniversary' => false
            );
            if(array_key_exists('first_name', $row)) {
                $dir[$family_id]['people'][$person_id]['first_name'] = $row['first_name'];
            }
            if(array_key_exists('last_name', $row)) {
                $dir[$family_id]['people'][$person_id]['last_name'] = $row['last_name'];
            }
            if(array_key_exists('person_type_name', $row)) {
                $dir[$family_id]['people'][$person_id]['type'] = $row['person_type_name'];
            }
            if(array_key_exists('relationship_type_name', $row)) {
                $dir[$family_id]['people'][$person_id]['relationship'] = $row['relationship_type_name'];
            }
            if(array_key_exists('people_phone', $row)) {
                $dir[$family_id]['people'][$person_id]['phone'] = $row['people_phone'];
            }
            if(array_key_exists('people_email', $row)) {
                $dir[$family_id]['people'][$person_id]['email'] = $row['people_email'];
            }
            if(array_key_exists('birthday', $row)) {
                $dir[$family_id]['people'][$person_id]['birthday'] = $row['birthday'];
            }
            if(array_key_exists('anniversary', $row)) {
                $dir[$family_id]['people'][$person_id]['anniversary'] = $row['anniversary'];
            }
        }

        return array("directory" => $dir);
    }
}
