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
    
    --Configuration de la base de donnée.
      Executer le fichier "Executable_ql.ql"
        La BDD possède local est configuré comme suit : username = "root" & password = "".
        Si votre BDD possède un autre compte administrateur, aller dans le fichier ./application/config/database.php
          Modifier les paramêtre du tableau $db[][].
        
    --Compte existant :
      UserName : ndaussy@hotmail.com
      Password : 243289
  
  
  --Configuration Wamp :
    Activer dans les extensions php, php_SOAP, pour que le service & sont consommateur puisse fonctionné. Le consomateur est accessible via l'adresse "http://127.0.0.1/PFE-Simulateur/Test_SOAP/SoapClient.php".
    Activer le port 800 dans le serveur apache, aller dans wamp, modifier le fichier httpd.conf, et rajouter le numeros 800 à coté des lignes
    #listen
    80
      
Information : 

  --Fichier : les fichiers de simulation ne sont pas stockés sur Github car trop lourd, ajouter les directement dans le 
  directory "upload" ou télécharger les avec l'interfaces.
