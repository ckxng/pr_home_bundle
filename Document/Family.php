<?php

/**********************************************************************
 *
 * CAUTION!
 *
 * This collection is overwritten by fixtures!
 *
 */

namespace Ecc12\PRHomeBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Ecc12\PRHomeBundle\Document\Person;

/**
 * @MongoDB\Document
 */
class Family {
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     * @MongoDB\Index
     */
    protected $name;

    /**
     * @MongoDB\String
     */
    protected $address_1;

    /**
     * @MongoDB\String
     */
    protected $address_2;

    /**
     * @MongoDB\String
     */
    protected $city;

    /**
     * @MongoDB\String
     */
    protected $state;

    /**
     * @MongoDB\String
     */
    protected $zipcode;

    /**
     * @MongoDB\String
     */
    protected $country;

    /**
     * @MongoDB\String
     */
    protected $email;

    /**
     * @MongoDB\String
     */
    protected $phone;

    /**
     * @MongoDB\ReferenceMany(targetDocument="Person", cascade="all")
     */
    protected $people = array();

    public function __construct()
    {
        $this->people = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Family
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address_1
     *
     * @param string $address1
     * @return Family
     */
    public function setAddress1($address1)
    {
        $this->address_1 = $address1;
        return $this;
    }

    /**
     * Get address_1
     *
     * @return string $address1
     */
    public function getAddress1()
    {
        return $this->address_1;
    }

    /**
     * Set address_2
     *
     * @param string $address2
     * @return Family
     */
    public function setAddress2($address2)
    {
        $this->address_2 = $address2;
        return $this;
    }

    /**
     * Get address_2
     *
     * @return string $address2
     */
    public function getAddress2()
    {
        return $this->address_2;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Family
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * Get city
     *
     * @return string $city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Family
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * Get state
     *
     * @return string $state
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     * @return Family
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string $zipcode
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Family
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * Get country
     *
     * @return string $country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Family
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Family
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Get phone
     *
     * @return string $phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Add people
     *
     * @param Ecc12\PRHomeBundle\Document\Person $people
     */
    public function addPeople(\Ecc12\PRHomeBundle\Document\Person $people)
    {
        $this->people[] = $people;
    }

    /**
     * Get people
     *
     * @return Doctrine\Common\Collections\Collection $people
     */
    public function getPeople()
    {
        return $this->people;
    }
}
