# Gestionnaire de Mot De Passe


---


## Introduction

---

### Objectif du projet

Le projet est un gestionnaire de mot de passe qui permet de stocker des mots de passe de manière sécurisée. Il permettra egalement de generer des mots de passe securisé ainsi que de les partager avec d'autres utilisateurs. Enfin le projet permettra de verifier la securité des mots de passe et leurs integrité en cas de fuite de données grace a l'api de **HaveIBeenPwned**.

### Fonctionnalités clés

- Gestion des utilisateurs
- Gestion des mots de passe
- Génération de mots de passe
- Partage de mots de passe
- Vérification de la sécurité des mots de passe


### Prérequis pour l'utilisation de l'application

- Un navigateur web
- Un compte utilisateur
- Une connexion internet

---

## Documentation utilisateur

---


### Comment installer l'application

L'application est disponible en ligne à l'adresse suivante : ***[insert link]***

### Comment utiliser l'application


#### 1. Créer un compte utilisateur
#### 2. Se connecter à son compte utilisateur
#### 3. Vérifier la sécurité des mots de passe
#### 4. Gérer ses mots de passe
#### 5. Générer des mots de passe
#### 6. Partager des mots de passe



### FAQ / Réponses aux questions courantes des utilisateurs


#### 1. Comment changer mon mot de passe ?

#### 2. Comment supprimer mon compte utilisateur ?


---
## Documentation développeur
---

### 1. Présentation technique

- Langage de programmation : PHP 8.1 
- Framework : Symfony 6.2 (MVC)
- Front-end : HTML5,préprocesseur SASS, JavaScript
- Base de données : MySQL 8.0
- Serveur web : Apache 2.4
- API : HaveIBeenPwned

### 2. Prérequis / Exigences pour le développement de l'application

- PHP 8.1 ou supérieur
- Composer 2.1 ou supérieur
- NodeJS 16.13 ou supérieur
- NPM 8.1 ou supérieur
- Symfony CLI 6.2 
- MySQL 8.0 ou supérieur
- Apache 2.4 ou supérieur



### 2. Cloner le code source

Pour cloner le code source du projet, il faut executer la commande suivante :


```bash
    git clone https://www.github.com/username/projectname.git
```


### 3. Comment installer les dépendances

Après avoir cloné le projet, il faut installer les dépendances du projet. Pour cela, il faut executer les commandes suivantes :

```bash
    composer install
```
```bash
    npm install
    npm install @symfony/stimulus-bridge


    # ou

    yarn install
    yarn add @symfony/stimulus-bridge
```	

### 4. Architecture / Structure du code

- src
    - Assets
        - styles
            - app.scss
            - abstracts
                - _placeholder.scss
                - _variables.scss
                - _index.scss

            - base
                - _base.scss
                - _typography.scss
            - components
                - _buttons.scss
                - _forms.scss
                - _grid.scss
                - _header.scss
                - _loader.scss
                - _modal.scss
                - _navbar.scss
                - _password.scss
                - _sidebar.scss
                - _table.scss

    - Controller
    - DataFixtures
    - Entity
    - Form
    - Repository
    - Security
    - Service
    - Twig
    - Validator
- templates
- public
    - build
    - css
    - images
    - js






### 1. Introduction

- Objectif du projet
- Résumé de l'application / fonctionnalités clés
- Prérequis / exigences pour l'utilisation de l'application

### 2. Documentation utilisateur

- Comment installer l'application
- Comment utiliser l'application
- FAQ / Réponses aux questions courantes des utilisateurs
- Contactez-nous / Support client

### 3. Documentation développeur

- presentation technique
- Prérequis / Exigences pour le développement de l'application
- Comment télécharger / cloner le code source
- Comment installer les dépendances
- Architecture / Structure du code
- Description des classes / fonctions principales
- Comment tester l'application
- Comment contribuer au projet
- Comment soumettre des problèmes ou des demandes d'amélioration.