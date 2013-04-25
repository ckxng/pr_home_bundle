<?php

namespace Ecc12\PRHomeBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ecc12\PRHomeBundle\Document\Family;
use Ecc12\PRHomeBundle\Document\Person;

class DirectoryFixtures implements FixtureInterface {

    public function load(ObjectManager $manager)
    {
        $xml = simplexml_load_file(__DIR__."/../../Resources/private/fixture/directory.xml");
        $xml = json_decode(json_encode($xml),1);
        $xml = $xml['directory'];
        $dir = array();

        foreach($xml as $row)
        {
            $family_id = $row['families_ID'];
            if(!array_key_exists($family_id, $dir)) {
                $family = new Family();
                if(array_key_exists('family_name', $row)) {
                    $family->setName($row['family_name']);
                }
                if(array_key_exists('address_1', $row)) {
                    $family->setAddress1($row['address_1']);
                }
                if(array_key_exists('address_2', $row)) {
                    $family->setAddress2($row['address_2']);
                }
                if(array_key_exists('city', $row)) {
                    $family->setCity($row['city']);
                }
                if(array_key_exists('state', $row)) {
                    $family->setState($row['state']);
                }
                if(array_key_exists('zipcode', $row)) {
                    $family->setZipcode($row['zipcode']);
                }
                if(array_key_exists('country', $row)) {
                    $family->setCountry($row['country']);
                }
                if(array_key_exists('families_email', $row)) {
                    $family->setEmail($row['families_email']);
                }
                if(array_key_exists('families_phone', $row)) {
                    $family->setPhone($row['families_phone']);
                }
                $dir[$family_id] = $family;
            }

            $person = new Person();
            if(array_key_exists('first_name', $row)) {
                $person->setFirstName($row['first_name']);
            }
            if(array_key_exists('last_name', $row)) {
                $person->setLastName($row['last_name']);
            }
            if(array_key_exists('sort', $row)) {
                $person->setSort($row['sort']);
            }
            if(array_key_exists('person_type_name', $row)) {
                $person->setType($row['person_type_name']);
            }
            if(array_key_exists('relationship_type_name', $row)) {
                $person->setRelationship($row['relationship_type_name']);
            }
            if(array_key_exists('people_phone', $row)) {
                $person->setPhone($row['people_phone']);
            }
            if(array_key_exists('people_email', $row)) {
                $person->setEmail($row['people_email']);
            }
            if(array_key_exists('birthday', $row)) {
                $person->setBirthday($row['birthday']);
            }
            if(array_key_exists('anniversary', $row)) {
                $person->setAnniversary($row['anniversary']);
            }

            $dir[$family_id]->addPeople($person);
        }

        foreach($dir as $key => $val) {
            $manager->persist($val);
        }

        $manager->flush();
    }
}
