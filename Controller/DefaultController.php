<?php

namespace Ecc12\PRHomeBundle\Controller;

use Stubs\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Ecc12\PRHomeStoreBundle\Document\Family;
use Ecc12\PRHomeStoreBundle\Document\Person;

/**
 * Class DefaultController
 * @Cache(expires="yesterday")
 */
class DefaultController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Template()
     */
    public function helloAction($in_name)
    {
        return array('name' => $in_name);
    }

    /**
     * @Route("/", name="index", defaults={"in_page_name" = "index"})
     * @Route("/page/{in_page_name}", name = "page", defaults={"in_page_name" = "index"})
     * @Template()
     */
    public function pageAction($in_page_name) {
        $content = "Page not found";
        $filename = __DIR__."/../Resources/private/page/$in_page_name.md";
        if(file_exists($filename)) {
            $content = file_get_contents($filename);
        }
        return array('content' => $content);
    }

    /**
     * @Route(
     *      "/directory/list",
     *      name="directory_list",
     *      defaults={
     *          "in_family_id" = -1,
     *          "in_family_name" = -1,
     *          "in_mode" = "list"
     *      })
     * @Route(
     *      "/directory/name/{in_family_name}",
     *      name="directory_name",
     *      defaults={
     *          "in_family_id" = -1,
     *          "in_family_name" = -1,
     *          "in_mode" = "detail"
     *      })
     * @Route(
     *      "/directory/{in_family_id}",
     *      name="directory",
     *      defaults={
     *          "in_family_id" = -1,
     *          "in_family_name" = -1,
     *          "in_mode" = "detail"
     *      })
     * @Template()
     * @Secure(roles="ROLE_USER")
     */
    public function directoryAction($in_mode, $in_family_id, $in_family_name)
    {
        $directory = array();

        $dm = $this->get('doctrine.odm.mongodb.document_manager');

        if($in_family_id != -1) {
            $families = $dm->createQueryBuilder('Ecc12PRHomeStoreBundle:Family')
                ->field('id')->equals($in_family_id)
                ->getQuery()
                ->execute();
        } elseif($in_family_name != -1) {
            $families = $dm->createQueryBuilder('Ecc12PRHomeStoreBundle:Family')
                ->field('name')->equals($in_family_name)
                ->getQuery()
                ->execute();
        } else {
            $families = $dm->createQueryBuilder('Ecc12PRHomeStoreBundle:Family')
                ->sort('name', 'asc')
                ->getQuery()
                ->execute();
        }

        foreach($families as $family) {
            $family_id = $family->getId();
            $directory[$family_id] = array(
                'id'        => $family->getId(),
                'name'      => $family->getName(),
                'address_1' => $family->getAddress1(),
                'address_2' => $family->getAddress2(),
                'city'      => $family->getCity(),
                'state'     => $family->getState(),
                'zipcode'   => $family->getZipcode(),
                'country'   => $family->getCountry(),
                'phone'     => $family->getPhone(),
                'email'     => $family->getEmail(),
                'people'    => array()
            );

            if($in_mode == "detail") {
                foreach($family->getPeople() as $person) {
                    $person = array(
                        'id'            => $person->getId(),
                        'first_name'    => $person->getFirstName(),
                        'last_name'     => $person->getLastName(),
                        'sort'          => $person->getSort(),
                        'type'          => $person->getType(),
                        'relationship'  => $person->getRelationship(),
                        'email'         => $person->getEmail(),
                        'phone'         => $person->getPhone(),
                        'birthday'      => $person->getBirthday()?
                            $person->getBirthday()->format('c'):false,
                        'anniversary'   => $person->getAnniversary()?
                            $person->getAnniversary()->format('c'):false,
                    );
                    $directory[$family_id]['people'][
                        "$person[sort]_$person[first_name]$person[last_name]"] = $person;
                }
            }
        }

        return array("directory" => $directory, "mode" => $in_mode);
    }
}
