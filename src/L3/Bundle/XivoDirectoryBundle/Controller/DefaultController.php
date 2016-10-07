<?php

namespace L3\Bundle\XivoDirectoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use OpenLdapObject\Builder\Query;
use OpenLdapObject\Builder\Condition;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $repo = $this->get('ldap_object.manager')->getRepository('\L3\Bundle\XivoDirectoryBundle\Entity\People');
        
        /* verification du nombre de caractères minimum avant de lancer la recherche */
        if (strlen($request->query->get('recherche')) < $this->container->getParameter('nombre_caracteres_min')) {
            return [ 'result' => null ];
        }
        
        /* découpage des arguments sur les espaces */
        $arguments = explode(' ', $request->query->get('recherche'));
        
        /* création d'une requête AND (&(arg1)(arg2)(...)) */
        $q = new Query(Query::CAND);
        
        /* parcours des arguments de la recherche */
        foreach ($arguments as $arg) {
            $conditions = [];
            
            /* création d'une condition par argument + ajout des wildcards au début et à la fin */
            foreach ($this->container->getParameter('attributs_recherche') as $attr) {
                $conditions[] = new Condition($attr, '*' . $arg . '*');
            }
            
            /* ajout des conditions dans une requête OR (|(arg1)(arg2)(...)) */
            $q->cOr($conditions);
        }
        
        /* dump($q->getQueryForRepository($repo)); */
        
        return [ 'result' => $repo->findByQuery($q) ];
    }
}
