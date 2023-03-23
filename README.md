## Laravel CRM API
projet teste Barkalab

### Démarrer le serveur 
##### php artisan serve
### Créer le premier utilisateur
##### php artisan db:seed
### Fichier test POSTMAN
##### régarder dans le repertoire fileJSON à la racine du projet.


## Projet : Panneau d'administration pour gérer les entreprises
L'objectif de ce test, est la réalisation d'un mini CRM API avec Laravel pouvant être testé sur Postman.
Description des besoins :
Mettre en place une Authenfication JWT, pour la connexion des administrateurs.
Utiliser les seeders Laravel pour créer le premier utilisateur avec « admin@admin.com » comme email et « P@ssword » comme mot de passe ;
- Mettre en place un CRUD (Créer/Lire/Mettre à jour/Supprimer) pour les entités
  Entreprise et employé;
- La table « Entreprise » se compose des champs suivants :
  • Nom (obligatoire)
  • Email (facultatif)
  La table « Employé » se compose des champs suivants :
  • Prénom (obligatoire)
  • Nom de famille (obligatoire)
  • Entreprise (clé étrangère vers les entreprises)
  • Email (facultatif)
  • Téléphone (facultatif)
  Utiliser les migrations de base de données pour créer les schémas ci-dessus;
  Utiliser la fonction de validation de Laravel, en utilisant les classes Request :
  Créer votre propre classe de validation, pour valider les numéros de téléphones o Les numéros de téléphones doivent respecter les regex suivantes :
  '^([+] (2] (2] [6]) (015-7] [4-7] [0-9]{6}$'
  // ORANGE
  1^([+] (21 (2) (6)) (0|5-71 (0-3) (0-9](6)5'
  // MOOV
  '^([+] [2] [2] [6]) (58|68|69|78|79) [0-9](6)$', // TELECEL
