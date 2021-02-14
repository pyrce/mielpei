# Installation

Tout d'abord cloner le projet

```cmd
git clone https://github.com/pyrce/mielpei.git
```

Placer vous dans le dossier

```cmd
cd mielpei
```

Installer les dépendances

```cmd
composer install
```

Ensuite pour créer les tables et les remplir

```cmd
php artisan migrate --seed
```

Lancer le serveur

```cmd
php artisan serve
```

Vous pouvez maintenant aller à l'adresse localhost:8000