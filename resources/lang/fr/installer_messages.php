<?php

return [

    /*
     * Traductions partagées.
     */
    'title' => 'Assistant d\'installation du système de réservation d\'inventaire',
    'next' => 'Étape suivante',
    'back' => 'Précédent',
    'finish' => 'Installer',
    'forms' => [
        'errorTitle' => 'Les erreurs suivantes se sont produites :',
    ],

    /*
     * Page d\'accueil.
     */
    'welcome' => [
        'templateTitle' => 'Bienvenue',
        'title' => 'Assistant d\'installation du système de réservation d\'inventaire',
        'message' => 'Assistant d\'installation et de configuration.',
        'next' => 'Vérifier les prérequis',
    ],

    /*
     * Page des prérequis.
     */
    'requirements' => [
        'templateTitle' => 'Étape 1 | Pré-requis serveur',
        'title' => 'Pré-requis serveur',
        'next' => 'Vérifier les permissions',
    ],

    /*
     * Page des permissions.
     */
    'permissions' => [
        'templateTitle' => 'Étape 2 | Permissions',
        'title' => 'Permissions',
        'next' => 'Configurer l\'environnement',
    ],

    /*
     * Page de l\'environnement.
     */
    'environment' => [
        'menu' => [
            'templateTitle' => 'Étape 3 | Paramètres de l\'environnement',
            'title' => 'Paramètres de l\'environnement',
            'desc' => 'Choisissez comment vous souhaitez configurer le fichier <code>.env</code> de l\'application.',
            'wizard-button' => 'Configuration guidée',
            'classic-button' => 'Éditeur de texte classique',
        ],
        'wizard' => [
            'templateTitle' => 'Étape 3 | Paramètres de l\'environnement | Assistant guidé',
            'title' => 'Assistant guidé de configuration <code>.env</code>',
            'tabs' => [
                'environment' => 'Environnement',
                'database' => 'Base de données',
                'application' => 'E-mail',
                'account' => 'Compte',
            ],
            'form' => [
                'name_required' => 'Un nom d\'environnement est requis.',
                'app_name_label' => 'Nom de l\'application',
                'app_name_placeholder' => 'Nom de l\'application',
                'app_environment_label' => 'Environnement',
                'app_environment_label_local' => 'Local',
                'app_environment_label_developement' => 'Développement',
                'app_environment_label_qa' => 'Qualif',
                'app_environment_label_production' => 'Production',
                'app_environment_label_other' => 'Autre',
                'app_environment_placeholder_other' => 'Saisissez votre environnement...',
                'app_debug_label' => 'Débogage',
                'app_debug_label_true' => 'Oui',
                'app_debug_label_false' => 'Non',
                'app_log_level_label' => 'Niveau de log',
                'app_log_level_label_debug' => 'debug',
                'app_log_level_label_info' => 'info',
                'app_log_level_label_notice' => 'notice',
                'app_log_level_label_warning' => 'warning',
                'app_log_level_label_error' => 'error',
                'app_log_level_label_critical' => 'critical',
                'app_log_level_label_alert' => 'alert',
                'app_log_level_label_emergency' => 'emergency',
                'app_url_label' => 'URL de l\'application',
                'app_url_placeholder' => 'URL de l\'application',
                'db_connection_failed' => 'Impossible de se connecter à la base de données.',
                'db_connection_label' => 'Connexion à la base de données',
                'db_connection_label_mysql' => 'mysql',
                'db_connection_label_sqlite' => 'sqlite',
                'db_connection_label_pgsql' => 'pgsql',
                'db_connection_label_sqlsrv' => 'sqlsrv',
                'db_host_label' => 'Hôte de la base de données',
                'db_host_placeholder' => 'Hôte de la base de données',
                'db_port_label' => 'Port de la base de données',
                'db_port_placeholder' => 'Port de la base de données',
                'db_name_label' => 'Nom de la base de données',
                'db_name_placeholder' => 'Nom de la base de données',
                'db_username_label' => 'Nom d\'utilisateur de la base de données',
                'db_username_placeholder' => 'Nom d\'utilisateur de la base de données',
                'db_password_label' => 'Mot de passe de la base de données',
                'db_password_placeholder' => 'Mot de passe de la base de données',

                'app_tabs' => [
                    'more_info' => 'Plus d\'infos',
                    'broadcasting_title' => 'Diffusion, cache, session et file d\'attente',
                    'broadcasting_label' => 'Driver de diffusion',
                    'broadcasting_placeholder' => 'Driver de diffusion',
                    'cache_label' => 'Driver de cache',
                    'cache_placeholder' => 'Driver de cache',
                    'session_label' => 'Driver de session',
                    'session_placeholder' => 'Driver de session',
                    'queue_label' => 'Driver de file d\'attente',
                    'queue_placeholder' => 'Driver de file d\'attente',
                    'redis_label' => 'Driver Redis',
                    'redis_host' => 'Hôte Redis',
                    'redis_password' => 'Mot de passe Redis',
                    'redis_port' => 'Port Redis',

                    'mail_label' => 'E-mail',
                    'mail_driver_label' => 'Driver e-mail',
                    'mail_driver_placeholder' => 'Driver e-mail',
                    'mail_host_label' => 'Hôte e-mail',
                    'mail_host_placeholder' => 'Hôte e-mail',
                    'mail_port_label' => 'Port e-mail',
                    'mail_port_placeholder' => 'Port e-mail',
                    'mail_username_label' => 'Nom d\'utilisateur e-mail',
                    'mail_username_placeholder' => 'Nom d\'utilisateur e-mail',
                    'mail_password_label' => 'Mot de passe e-mail',
                    'mail_password_placeholder' => 'Mot de passe e-mail',
                    'mail_encryption_label' => 'Chiffrement e-mail',
                    'mail_encryption_placeholder' => 'Chiffrement e-mail',

                    'account_forename_label' => 'Prénom du compte',
                    'account_surname_label' => 'Nom du compte',
                    'account_email_label' => 'E-mail du compte',
                    'account_password_label' => 'Mot de passe du compte',

                    'pusher_label' => 'Pusher',
                    'pusher_app_id_label' => 'ID de l\'application Pusher',
                    'pusher_app_id_palceholder' => 'ID de l\'application Pusher',
                    'pusher_app_key_label' => 'Clé Pusher',
                    'pusher_app_key_palceholder' => 'Clé Pusher',
                    'pusher_app_secret_label' => 'Secret Pusher',
                    'pusher_app_secret_palceholder' => 'Secret Pusher',
                ],
                'buttons' => [
                    'setup_database' => 'Configurer la base de données',
                    'setup_mail' => 'Configurer l\'e-mail',
                    'setup_account' => 'Configurer le compte',
                    'install' => 'Installer',
                ],
            ],
        ],
        'classic' => [
            'templateTitle' => 'Étape 3 | Paramètres de l\'environnement | Éditeur classique',
            'title' => 'Éditeur classique de l\'environnement',
            'save' => 'Enregistrer le fichier .env',
            'back' => 'Utiliser l\'assistant guidé',
            'install' => 'Enregistrer et installer',
        ],
        'success' => 'Les paramètres de votre fichier .env ont bien été enregistrés.',
        'errors' => 'Impossible d\'enregistrer le fichier .env. Veuillez le créer manuellement.',
    ],

    'install' => 'Installer',

    /*
     * Journal d\'installation.
     */
    'installed' => [
        'success_log_message' => 'Laravel Installer a bien été installé le ',
    ],

    /*
     * Page finale.
     */
    'final' => [
        'title' => 'Installation terminée',
        'templateTitle' => 'Installation terminée',
        'finished' => 'L\'application a été installée avec succès.',
        'migration' => 'Sortie de la console de migration et de seed :',
        'console' => 'Sortie de la console de l\'application :',
        'log' => 'Entrée du journal d\'installation :',
        'env' => 'Fichier .env final :',
        'exit' => 'Cliquez ici pour quitter',
    ],

    /*
     * Traductions spécifiques à la mise à jour.
     */
    'updater' => [
        'title' => 'Mise à jour Laravel',

        'welcome' => [
            'title' => 'Bienvenue dans le programme de mise à jour',
            'message' => 'Bienvenue dans l\'assistant de mise à jour.',
        ],

        'overview' => [
            'title' => 'Aperçu',
            'message' => 'Il y a 1 mise à jour.|Il y a :number mises à jour.',
            'install_updates' => 'Installer les mises à jour',
        ],

        'final' => [
            'title' => 'Terminé',
            'finished' => 'La base de données de l\'application a été mise à jour avec succès.',
            'exit' => 'Cliquez ici pour quitter',
        ],

        'log' => [
            'success_message' => 'Laravel Installer a bien été mis à jour le ',
        ],
    ],
];
