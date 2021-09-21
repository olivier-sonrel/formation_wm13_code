database password root : 0000
users : mario : ma
        Lara : la
        etc

# PHP
## Exo 1
Faire en sorte que le "bouton" utilisateur, un menu déroulant s'affiche avec le bouton de déconnexion.


## Exo 2
Faire une page __infos.php__ dans laquelle on retrouvera une image et un paragraphe de texte.  
Créer un bouton dans le menu pour accéder à cette page.

Si vous n'êtes pas connecté, la page affiche un message de type "Vous devez être connecté pour accéder à cette page".

## Exo 3
Créer page "Profil" (profil.php).
Cette page contiendra les préférences de l'utilisateurs.
Ainsi, il pourra choisir d'afficher ou non, et l'image et le texte de la page __infos.php__.

## Au final, le menu :
>Si non connecté :
>- Accueil (1)
>- Utilisateurs (1)
>- Infos (2)
>- Connexion (1)

>Si oui :
>- Accueil (1)
>- Utilisateurs (1)
>- Infos (2)
>- Bouton utlisateur : (1)
>  - Déconnexion (1)
>  - Profil (3)


## Exo 3bis
Faire en sorte que les options d'affichages restent selectionnées.

## Exo 4
Ajouter un "vrai" système de connexion. Il faudra donc le bon login avec le bon mot de passe pour se connecter.
Si les mauvais log sont entrés, rebasculer sur la page de connexion.

## Exo 4 bis
Lorsque l'on rebascule sur la page de connexion suite à des mauvais logs, ça nous affiche tout de même le nom que l'on avait entré.

## Exo 5
- Réflexion sur les mots de passes (qu'est-ce qu'un bon mot de passe, méthode pour cracker un compte)
- (x) Différence entre hashage, cryptage et encodage.
- (x) Qu'est-ce qu'un grain de sel (salt)?


## Exo 6
- Faire en sorte que connexion et inscription sur meme page
- Use JS pour change formulaire

## Exo 7
- A l'inscription double verif mdp
- 2 input mdp
- Dans controller verif si les 2 identique
- Si non renvoi sur formulaire

## Exo 8
Faire que bouton valid inscription desactive par defaut
Actif si 2 mdp identique --JS--

## Exo 9
hasher mdp
