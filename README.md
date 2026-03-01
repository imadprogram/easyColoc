# 🏡 EasyColoc

**EasyColoc** est une application web moderne conçue pour simplifier la vie en communauté. Fini les disputes sur "qui doit quoi à qui", EasyColoc gère automatiquement le partage des dépenses et l'équilibre des comptes de votre colocation, tout en offrant une interface premium et intuitive.

---

## ✨ Fonctionnalités Principales

*   **📊 Tableau de Bord Premium**: Une interface utilisateur moderne et réactive (Tailwind CSS & Alpine.js) pour visualiser en un clin d'œil la santé financière de la colocation.
*   **💸 Suivi des Dépenses Avancé**:
    *   Ajout de dépenses avec titre, montant et catégorie personnalisable.
    *   Filtrage des dépenses par mois.
    *   Visualisation des statistiques de dépenses par catégorie.
*   **⚖️ Calcul Automatique des Dettes (Settlements)**: L'algorithme d'EasyColoc calcule automatiquement qui doit rembourser qui, de la manière la plus optimisée possible, afin que les comptes soient toujours équilibrés entre les membres actifs lors de la dépense.
*   **👥 Gestion des Membres**:
    *   **Invitations Sécurisées**: Invitez vos colocataires via un lien sécurisé. Les invités doivent accepter ou décliner l'invitation.
    *   **Départs Volontaires**: Un membre peut quitter la colocation de lui-même.
    *   **Gestion par l'Owner**: L'hôte (Owner) peut retirer (kick) un membre.
    *   **Fermeture**: L'hôte peut annuler/fermer la colocation.
*   **⭐ Système de Réputation**: Responsabilisation des utilisateurs !
    *   Quitter ou annuler une colocation **les comptes à jour** donne un bonus de **+1**.
    *   Quitter avec **des dettes impayées** entraîne un malus de **-1**. En cas de "Kick", la dette est transférée à l'Owner pour ne pas léser la communauté.
*   **👨‍💼 Administration Globale**:
    *   Le premier utilisateur inscrit devient automatiquement l'Admin Global.
    *   Vue d'ensemble sur les statistiques globales de la plateforme.
    *   Possibilité de **bannir** des utilisateurs malveillants. Les utilisateurs bannis sont automatiquement déconnectés et exclus de l'application.

---

## 🛠️ Stack Technique

*   **Backend**: Laravel 11.x (PHP 8.2+)
*   **Frontend**: Blade, Tailwind CSS, Alpine.js
*   **Base de données**: MySQL / PostgreSQL compatibles

---

## 🚀 Installation

1.  **Cloner le dépôt :**
    ```bash
    git clone https://github.com/votre-nom/easycoloc.git
    cd easycoloc
    ```

2.  **Installer les dépendances PHP :**
    ```bash
    composer install
    ```

3.  **Installer les dépendances Node :**
    ```bash
    npm install
    npm run build
    ```

4.  **Configuration de l'environnement :**
    *   Copier `.env.example` vers `.env`
    *   Configurer les identifiants de base de données dans `.env`
    *   Générer la clé d'application :
        ```bash
        php artisan key:generate
        ```

5.  **Migrations et Seeders :**
    Exécutez les migrations (les seeders peuvent générer des utilisateurs et catégories de test) :
    ```bash
    php artisan migrate
    ```

6.  **Démarrer le serveur local :**
    ```bash
    php artisan serve
    ```

L'application sera accessible sur `http://localhost:8000`.

---

## 🛡️ Fonctionnement du Système de Dettes

EasyColoc ne divise pas aveuglément les factures par le nombre total de membres. Le système vérifie **qui était présent dans la colocation au moment précis de l'achat** (basé sur les dates d'`inscription`/`départ`). Cela garantit une équité totale, notamment lorsqu'un colocataire arrive en milieu de mois.
