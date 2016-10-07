Description
====
Application Symfony 2.7 provide a directory internal white page with phone numbers for Xivo throw a webservice who returns datas in CSV format.

Documentation usefull :
   * http://documentation.xivo.io/en/stable/administration/directories/directories.html
   * http://documentation.xivo.io/en/stable/system/xivo-dird/integration.html#dird-integration-views

Installation and configuration of the application
====
- Clone the sources from github or packagist
- Create and configure the file 'app/config/parameters.yml' from the following example. (this step is important)

```
parameters:
    # Config de la connexion au LDAP pour la recherche :
    ldap_host: 'ldap.univ-lille3.fr'
    ldap_port: 389
    ldap_base_dn: 'dc=univ-lille3,dc=fr'
    ldap_user: 'utilisateur_ldap'
    ldap_password: 'mdp_utilisateur_ldap'

    # Config du nombre minimum de caractères requis pour lancer la recherche
    nombre_caracteres_min: 3

    # Config des attributs du LDAP sur lesquels la recherche doit s'effectuer.
    # Attention: Les champs choisis DOIVENT être présents dans l'entitée People !
    attributs_recherche:
        - sn
        - givenName
        - lille3TelephoneFunction
``` 

- Launch the command **composer install**

Configuration de Xivo
====

