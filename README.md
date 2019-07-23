PFE-Simulateur
==============


Configuration :

  --Configuration du framework :
  
    --Configuration de l'adresse du site (si on renomme le dossier du dépot).
      vous devez aller dans ./application/config/config.php et modifier la valeur de la variable 
      $config['base_url']	= 'http://localhost/cheminVersDossier [normalement: PFE-Simulateur]';

    --Configuration du chemin vers l'executable.
      Aller dans le dossier config, ouvrir le fichier config_path, modifier le chemin de la variable.
    ! Le nom de l'executable doit être "sendDataDungle" et se situer dans le dossier ./application/prog_C/
    
      --Configuration Wamp/Lamp :
      Configurer votre php.ini pour pouvoir uploader des fichiers supérieures à 200MO, pour cela ouvrer le fichier php.ini ( var/phpX/.. pour ubuntu & c:/wamp/php.. pour windows ). Trouver les lignes post_max_size = XXM && upload_max_filesize = XM.
      
      Activé "Allow_url_require" dans php ini.
      
      Activé php_socket dans les extensions php, si ce n'est pas fait vous aurez une erreur en fin de simulation lors de
      l'arret des services GPS.
    
    --Configuration uploads. crée un dossier 'uploads'  la racine du projet. c-a-d PFE-simulateur/uploads 
    
    --Configuration de la base de donnée.
      
      Executer le fichier "Executable_ql.ql", Attention si vous ne réalisez pas cette étapes le site ne fonctionnera pas!.
      En cas d'erreurs 500 serveur apaches ( page blanche ) sous ubuntu, n'oubliez pas de modifier les droits d'accés de tous le dossier PFE-Simulateur ( cmd = chmod -R 777 /PFE-simulateur )
      
        La BDD possède local est configuré comme suit : username = "root" & password = "".
        Si votre BDD possède un autre compte administrateur, aller dans le fichier ./application/config/database.php
          Modifier les paramêtre du tableau $db[][].
        
    --Compte existant :
      UserName : ndaussy@wanadoo.com
      Password : ********
  
  

      
Information : 

  --Fichier : les fichiers de simulation ne sont pas stockés sur Github car trop lourd, ajouter les directement dans le 
  directory "upload" ou télécharger les avec l'interfaces.
