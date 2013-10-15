<?php

namespace Ecc12\PRHomeBundle\Model;

use Ecc12\PRHomeBundle\Document\Family;
use Ecc12\PRHomeBundle\Document\Person;

class Directory {

    function __construct() {


    }

    function load() {

        /* unstaged.. how to get this->get outside of app? */

        $directory = array();

        $dm = $this->get('doctrine.odm.mongodb.document_manager');

        $families = $dm->createQueryBuilder('Ecc12PRHomeBundle:Family')
            ->sort('name', 'asc')
            ->getQuery()
            ->execute();

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



    }

}
