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

/**
 * @MongoDB\Document
 */
class MedicalRelease {
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     * @MongoDB\Index
     */
    protected $first_name;

    /**
     * @MongoDB\String
     * @MongoDB\Index
     */
    protected $last_name;

    /**
     * @MongoDB\Int
     * @MongoDB\Index
     */
    protected $sort;

    /**
     * @MongoDB\String
     * @MongoDB\Index
     */
    protected $type;

    /**
     * @MongoDB\String
     * @MongoDB\Index
     */
    protected $relationship;

    /**
     * @MongoDB\String
     */
    protected $email;

    /**
     * @MongoDB\String
     */
    protected $phone;

    /**
     * @MongoDB\Date
     */
    protected $birthday;

    /**
     * @MongoDB\Date
     */
    protected $anniversary;


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
     * Set first_name
     *
     * @param string $firstName
     * @return Person
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;
        return $this;
    }

    /**
     * Get first_name
     *
     * @return string $firstName
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set last_name
     *
     * @param string $lastName
     * @return Person
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;
        return $this;
    }

    /**
     * Get last_name
     *
     * @return string $lastName
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Person
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
     * @return Person
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
     * Set birthday
     *
     * @param date $birthday
     * @return Person
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * Get birthday
     *
     * @return date $birthday
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set anniversary
     *
     * @param date $anniversary
     * @return Person
     */
    public function setAnniversary($anniversary)
    {
        $this->anniversary = $anniversary;
        return $this;
    }

    /**
     * Get anniversary
     *
     * @return date $anniversary
     */
    public function getAnniversary()
    {
        return $this->anniversary;
    }

    /**
     * Set sort
     *
     * @param int $sort
     * @return Person
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
        return $this;
    }

    /**
     * Get sort
     *
     * @return int $sort
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Person
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set relationship
     *
     * @param string $relationship
     * @return Person
     */
    public function setRelationship($relationship)
    {
        $this->relationship = $relationship;
        return $this;
    }

    /**
     * Get relationship
     *
     * @return string $relationship
     */
    public function getRelationship()
    {
        return $this->relationship;
    }
}
