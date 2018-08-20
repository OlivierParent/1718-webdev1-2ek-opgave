CloCart
=======

Installation
------------

```
PS> MySQLCreateDatabaseUserAndDatabase -Course webdev1
PS> c 1718-webdev1-2ek
PS> cd lumen
PS> composer create-project
```

Configuration
-------------

Change `.env`:

```
DB_DATABASE=webdev1-db
DB_USERNAME=webdev1-user
DB_PASSWORD=webdev1-pass
```

Initialization
--------------

> Make sure MySQL is running!

```
PS> c 1718-webdev1-2ek
PS> cd lumen
PS> artisan migrate --seed
```

Reset
-----

```
PS> c 1718-webdev1-2ek
PS> cd lumen
PS> artisan migrate:reset; artisan migrate --seed
```

Host
----

```
PS> c 1718-webdev1-2ek
PS> cd lumen
PS> php -S localhost:8080 -t public
```

Test Users
----------

- Admin  
  `admin@gdm.gent`  
  `secret`
- User  
  `user@gdm.gent`  
  `secret`