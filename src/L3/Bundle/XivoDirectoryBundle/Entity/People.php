<?php

namespace L3\Bundle\XivoDirectoryBundle\Entity;

use OpenLdapObject\Annotations as OLO;
use OpenLdapObject\Entity;

/**
 * Classe permettant de récupérer les attributs des personnes dans le LDAP.
 * 
 * @OLO\Dn(value="ou=people")
 * @OLO\Entity({"top", "supannPerson", "lille3Person", "inetOrgPerson"})
 */
class People extends Entity {

    /**
     * @OLO\Column(type="string")
     * @OLO\Index
     */
    private $uid;
    
    /**
     * @OLO\Column(type="string")
     */
    private $supannCivilite;
    
    /**
     * @OLO\Column(type="string")
     */
    private $sn;
    
    /**
     * @OLO\Column(type="string")
     */
    private $givenName;
    
    /**
     * @OLO\Column(type="string")
     */
    private $mail;
    
    /**
     * @OLO\Column(type="array")
     */
    private $lille3TelephoneFunction;
    
    
    public function getUid() {
        return $this->uid;
    }

    public function setUid($value) {
        $this->uid = $value;
        return $this;
    }
    
    public function getSupannCivilite() {
        return $this->supannCivilite;
    }

    public function setSupannCivilite($value) {
        $this->supannCivilite = $value;
        return $this;
    }
    
    public function getSn() {
        return $this->sn;
    }

    public function setSn($value) {
        $this->sn = $value;
        return $this;
    }
    
    public function getGivenName() {
        return $this->givenName;
    }

    public function setGivenName($value) {
        $this->givenName = $value;
        return $this;
    }
    
    public function getMail() {
        return $this->mail;
    }

    public function setMail($value) {
        $this->mail = $value;
        return $this;
    }
    
    public function getLille3TelephoneFunction() {
        return $this->lille3TelephoneFunction;
    }

    public function setLille3TelephoneFunction($value) {
        $this->lille3TelephoneFunction = $value;
        return $this;
    }
}
