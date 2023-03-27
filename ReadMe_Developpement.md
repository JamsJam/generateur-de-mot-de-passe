# Gestionnaire de Mot De Passe

---
##  Documentation développeur
---

ceci est le readme de l'application destiné au développeur

### 1. Présentation technique


- Langage de programmation : PHP 8.1 
- Front-end : HTML5,préprocesseur SASS, JavaScript
- Framework : Symfony 6.2 (MVC), SASS 1.43.4 (CSS), webpack encore 1.0.0 (JS)
- Base de données : MySQL 8.0
- Serveur web : Apache 2.4
- API : HaveIBeenPwned



### 2. Prérequis / Exigences pour le développement de l'application

Les prérequis pour le développement de l'application sont les suivants :

- PHP 8.1 ou supérieur
- Composer 2.1 ou supérieur
- NodeJS 16.13 ou supérieur
- NPM 8.1 ou supérieur
- Symfony CLI 6.2 
- MySQL 8.0 ou supérieur
- Apache 2.4 ou supérieur

### 3. Liste des dépendances

Les dépendances indispensable au projets sont les suivantes :

#### 3.1. Composer

-   Webpack Encore Bundle 1.16.0

    ```shell
    composer require symfony/webpack-encore-bundle 
    ``` 
    - Permet d'utiliser webpack encore pour injecter des dependances dans le projet via NPM

-   FakerPHP/Faker
    ```shell    
    composer require symfony/phpFaker --dev 
    ```
    - Permet de generer des données de test a partir de fausses données 



#### 3.2. NPM

-   @symfony/stimulus-bridge
    ```shell
    npm install @symfony/stimulus-bridge
    ```
    - Permet d'utiliser StimulusJS dans le projet

-   @symfony/webpack-encore
    ```shell
    npm install @symfony/webpack-encore --save-dev
    ```
    - Permet d'utiliser webpack encore dans le projet

-   Preprocessor SASS
    ```shell
    npm install sass --save-dev
    ```
    - Permet d'utiliser SASS dans le projet







### 3. Cloner le code source

Pour cloner le code source du projet, il faut executer la commande suivante :


```bash
    git clone https://www.github.com/username/projectname.git
```


### 4. Comment installer les dépendances

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

### 5. Architecture / Structure du code

Le projet est structuré de la manière suivante :


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
                - _index.scss
                - _typography.scss
            - components
                - _index.scss
                - _nav.scss
                - _buttons.scss
                - _inputs.scss
            - pages
                - _index.scss
                - _home.scss
                - _login.scss
                - _register.scss
                - user
                    - _index.scss
                    - _edit.scss
                    - _show.scss
                - confidentialite
                    - _index.scss
                    - _show.scss
                    - _edit.scss
                    - add.scss
                - logs
                    - _index.scss
                    - _show.scss
                    - _edit.scss
                    - add.scss

    - Controller
        - HomeController.php
        - LoginController.php
        - RegisterController.php
        - MotDePasseController.php
        - UserController.php
        - ConfidentialiteController.php
        - LogsController.php
    - DataFixtures
        - AppFixtures.php
    - Entity
        - User.php
        - MotDePasse.php
        - Confidentialite.php
        - Logs.php
    - Form
        - MotDePasseType.php
        - UserType.php
        - ConfidentialiteType.php
    - Repository
        - UserRepository.php
        - MotDePasseRepository.php
        - ConfidentialiteRepository.php
        - LogsRepository.php

- templates
    - base.html.twig
    - home
        - index.html.twig
    - login
        - index.html.twig
    - register
        - index.html.twig
    - motdepasse
        - index.html.twig
        - show.html.twig
        - edit.html.twig
        - add.html.twig
    - user
        - index.html.twig
        - show.html.twig
        - edit.html.twig
    - confidentialite
        - index.html.twig
        - show.html.twig
        - edit.html.twig
        - add.html.twig
    - logs
        - index.html.twig
    

- public
    - build
    - css
    - images
    - js
    - index.php

- .env
- .gitignore
- composer.json
- composer.lock
- package.json
- package-lock.json
- ReadMe.md
- symfony.lock
- webpack.config.js



### 6. Description des classes / fonctions principales


#### 1. HomeController.php

HomeController.php est la classe qui gère les routes de la page d'accueil.

#### 2. LoginController.php
    
LoginController.php est la classe qui gère les routes de la page de connexion.

#### 3. RegisterController.php

RegisterController.php est la classe qui gère les routes de la page d'inscription.

#### 4. MotDePasseController.php
    
MotDePasseController.php est la classe qui gère les routes de la page de gestion des mots de passe.

#### 5. UserController.php

UserController.php est la classe qui gère les routes de la page de gestion des utilisateurs.

#### 6. ConfidentialiteController.php

ConfidentialiteController.php est la classe qui gère les routes de la page de gestion de l'accessibilité des mots de passe.

#### 7. LogsController.php

LogsController.php est la classe qui gère les routes de la page de gestion des logs. A savoir, les logs sont les actions effectuées par les utilisateurs sur l'application.


### 7. Comment tester l'application en local

Pour tester l'application, il faut executer la commande suivante :

```bash
    symfony serve

    # ou

    php -S localhost:8000 -t public
```

### 8. Comment contribuer au projet

Pour contribuer au projet, il faut suivre les étapes suivantes :

- Forker le projet
- Cloner le projet
- Créer une nouvelle branche
- Faire les modifications nécessaires
- Commiter les modifications
- Pusher les modifications
- Créer une nouvelle pull request