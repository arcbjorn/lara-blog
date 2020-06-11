# Blog platform

Using this app you can create blog account, follow other blog accounts, read blog posts and make new posts in your blog.

## using Laravel, Vue, SQLite

### 1. Clone repository

```
git clone https://github.com/arcbjorn/lara-blog.git
```

### 2. Install Composer dependencies (to run php)

```
cd lara-blog
composer install
```

<details>
 <summary>Don’t forget that you need php-gd and php-sqlite extentions. You can check and activate your extentions in <strong>php.ini</strong></summary>
</details>

### 3. Make Default Migrations

```
php artisan migrate
```

### 4. Start the server

```
php artisan serve
```

### 5. Install NPM Dependencies (to run js)

```
npm install
```

### 6. Run the front end of the app in development mode (with recomply on changes)

```
npm run watch
```

App on the port:
[http://localhost:3000](http://localhost:3000).