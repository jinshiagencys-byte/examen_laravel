# Application de Gestion des Prêts de Matériels

> **Origine du projet** : Ce projet est basé sur l'application open-source [Inventory Booking System](https://github.com/Dragnogd/Inventory-Booking-System) initialement développée par Ryan Coombes. Il a été adapté et entièrement traduit en français dans le cadre de l'évaluation du module Atelier Laravel.

Application web développée avec **Laravel** et **Livewire** permettant de gérer les matériels informatiques, d'organiser les réservations, de suivre les emprunts/retours et de gérer les incidents.

---

## 🚀 Fonctionnalités Principales

- **Gestion des Utilisateurs** : Création, modification et gestion des comptes utilisateurs.
- **Gestion des Matériels & Équipements** : Suivi des équipements et de leur état de disponibilité en temps réel.
- **Gestion des Emprunts et Retours** : Réservation et enregistrement des prêts avec contrôle des périodes de mise à disposition.
- **Gestion des Préparations (Setups)** : Planification des livraisons et des installations de matériel.
- **Suivi des Incidents** : Déclaration des pannes/casse de matériel et routage des alertes via des groupes de distribution.
- **Gestion des Sites & Emplacements** : Organisation des équipements par site physique.
- **Configuration & Notifications** : Paramétrage de la messagerie pour l'envoi automatique de notifications par e-mail.

---

## 🛠️ Stack Technique

- **Framework PHP** : Laravel 10
- **Composants Réactifs** : Livewire 2
- **Interface Utilisateur** : Blade, Bootstrap 4, FontAwesome 6, AlpineJS
- **Base de Données** : MySQL 8 / MariaDB
- **Conteneurisation** : Docker & Docker Compose

---

## 📦 Installation et Lancement

### Avec Docker (Recommandé)

1. **Cloner le projet** :
   ```bash
   git clone https://github.com/jinshiagencys-byte/examen_laravel.git
   cd examen_laravel
   ```

2. **Lancer les conteneurs** :
   ```bash
   docker compose up -d --build
   ```

3. **Accéder à l'application** :
   Ouvrez le navigateur à l'adresse [http://127.0.0.1:8000](http://127.0.0.1:8000) ou [http://localhost:8000](http://localhost:8000).

---

## 🔑 Accès par Défaut

- **Identifiant** : `admin@examen.test`
- **Mot de passe initial** : `admin123` *(une redirection vers le changement de mot de passe est effectuée lors de la première connexion)*.
- **Inscription** : Un formulaire d'inscription est disponible sur `/register`.

---

## 📜 Licence

Ce projet est distribué sous la licence [MIT](LICENSE).
