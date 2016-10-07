<?php

namespace L3\Bundle\XivoDirectoryBundle\Twig;

/**
 * Classe regroupant des filtres Twig pour extraire des informations depuis le champ
 * lille3TelephoneFunction récupéré depuis le LDAP.
 *
 */
class Lille3TelephoneFunctionParserExtension extends \Twig_Extension {

    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('telephoneParser', array($this, 'telephoneParserFilter')),
            new \Twig_SimpleFilter('fonctionParser', array($this, 'fonctionParserFilter')),
            new \Twig_SimpleFilter('structureParser', array($this, 'structureParserFilter')),
            new \Twig_SimpleFilter('localParser', array($this, 'localParserFilter')),
        );
    }

    /**
     * Fonction permettant d'extraire le numero de poste de la ligne.
     * ex:  [tel={prefix}+33 32000{poste}0000] 
     * =    6417
     * 
     * @param string $lille3TelephoneFunction
     * @return string
     */
    public function telephoneParserFilter($lille3TelephoneFunction) {
        /* extraction les chiffres après {poste} */
        if (preg_match("/\[tel={prefix}.*{poste}(\d+)\]/", $lille3TelephoneFunction, $res)) {
            return $res[1];
        }

        return null;
    }

    /**
     * Fonction permettant d'extraire la fonction de la personne reliée à la ligne.
     * ex:  [fonction=Responsable administratif]
     * =    Responsable administratif
     * 
     * @param string $lille3TelephoneFunction
     * @return string
     */
    public function fonctionParserFilter($lille3TelephoneFunction) {
        /* extraction des caractères après fonction= */
        if (preg_match("/\[fonction=([\w\s]*)\]/", $lille3TelephoneFunction, $res)) {
            return $res[1];
        }

        return null;
    }

    /**
     * Fonction permettant d'extraire la structure reliée à la ligne.
     * ex:  [local={struct}DSI{local}A2.999]
     * =    DSI
     * 
     * @param string $lille3TelephoneFunction
     * @return string
     */
    public function structureParserFilter($lille3TelephoneFunction) {
        /* extraction des caractères après {struct} */
        if (preg_match("/\[local={struct}(\w+).*\]/", $lille3TelephoneFunction, $res)) {
            return $res[1];
        }

        return null;
    }
    
    /**
     * Fonction permettant d'extraire le local reliée à la ligne.
     * ex:  [local={struct}DSI{local}A2.999]
     * =    A2.999
     * 
     * @param string $lille3TelephoneFunction
     * @return string
     */
    public function localParserFilter($lille3TelephoneFunction) {
        /* extraction des caractères après {local} */
        if (preg_match("/\[local={struct}.*{local}(.*)\]/", $lille3TelephoneFunction, $res)) {
            return $res[1];
        }

        return null;
    }

    public function getName() {
        return 'Lille3TelephoneFunctionParserExtension';
    }

}
