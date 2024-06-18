<div align="center" id="top"> 
  <img src="https://raw.githubusercontent.com/xXehub/final-supermarket-web/main/screenshot/panel_dashboard.png" width="900" alt="System Management Barang" />

  <a href="#">Demo</a>

&#xa0;

  <!-- <a href="https://systememployeemain.netlify.app">Demo</a> -->
</div>

<h1 align="center">Final Assigment UAS System Supermarket</h1>

<p align="center">
  <img alt="Github top language" src="https://img.shields.io/github/languages/top/xXehub/final-supermarket-web?">

  <img alt="Github language count" src="https://img.shields.io/github/languages/count/xXehub/final-supermarket-web?">

<!-- commit frequency -->
  <a href="https://github.com/xXehub/final-supermarket-web/commits/main" target="_blank">
    <img src="https://img.shields.io/github/commit-activity/m/xXehub/final-supermarket-web?" alt="Badge showing average commit frequency per month"/>
  </a>

  <!-- last commit -->
  <a href="https://github.com/xXehub/final-supermarket-web/commits/main" target="_blank">
    <img src="https://img.shields.io/github/last-commit/xXehub/final-supermarket-web?" alt="Badge showing when the last commit was made"/>
  </a>

  <img alt="Repository size" src="https://img.shields.io/github/repo-size/xXehub/final-supermarket-web?">

  <a href="https://github.com/xXehub/final-supermarket-web/blob/master/LICENSE.md" target="_blank">
    <img alt="Badge showing project license type" src="https://img.shields.io/github/license/xXehub/final-supermarket-web?color=f85149">

  </a>

  <!-- <img alt="Github issues" src="https://img.shields.io/github/issues/xXehub/final-supermarket-web?color=56BEB8" /> -->

  <!-- <img alt="Github forks" src="https://img.shields.io/github/forks/xXehub/final-supermarket-web?color=56BEB8" /> -->

  <!-- <img alt="Github stars" src="https://img.shields.io/github/stars/xXehub/final-supermarket-web?color=56BEB8" /> -->
</p>

<!-- Status -->

<!-- <h4 align="center">
	🚧  System Employee Main 🚀 Under construction...  🚧
</h4>

<hr> -->

<p align="center">
  <a href="#dart-about">About</a> &#xa0; | &#xa0; 
  <!-- <a href="#sparkles-features">Features</a> &#xa0; | &#xa0; -->
  <!-- <a href="#rocket-technologies">Technologies</a> &#xa0; | &#xa0; -->
  <a href="#file_folder-requirements">Requirements</a> &#xa0; | &#xa0; 
  <a href="#book-setup">Setup</a> &#xa0; | &#xa0;
  <a href="#gear-konfigurasi">Konfigurasi</a> &#xa0; | &#xa0;
  <a href="#memo-license">License</a> &#xa0; | &#xa0;
  <a href="https://github.com/xXehub" target="_blank">Author</a>
</p>

<br>

## :dart: Tentang Project

**This project is under development** - Aplikasi web berbasis Laravel ini adalah **proyek tugas kampus** yang dikembangkan menggunakan kerangka kerja PHP Laravel 

<!-- ## :sparkles: Features

:heavy_check_mark: Feature 1;\
:heavy_check_mark: Feature 2;\
:heavy_check_mark: Feature 3; -->
<!--
## :rocket: Technologies

The following tools were used in this project:

-   [Xampp](https://expo.io/)
-   [Node.js](https://nodejs.org/en/)
-   [Composer](https://pt-br.reactjs.org/)
-   [PHP](https://reactnative.dev/) -->

## :file_folder: Requirements

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?&style=for-the-badge&logo=laravel&logoColor=white)
![Nodejs](https://img.shields.io/badge/node.js-%23339933.svg?&style=for-the-badge&logo=node.js&logoColor=white)
![Composer](https://img.shields.io/badge/composer-%23885630.svg?&style=for-the-badge&logo=composer&logoColor=white)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?&style=for-the-badge&logo=php&logoColor=white)

Sebelum melakukan setup / installasi, harus sudah menginstall **[Git](https://git-scm.com)**,  **[PHP 8.0 atau lebih tinggi](https://www.php.net/downloads.php)**, **Web server** (Apache, Nginx, dll.), **Database server** (MySQL, PostgreSQL, SQLite, dll.), **[Node](https://nodejs.org/en/)** dan **[Composer](https://getcomposer.org)**.

## :book: Setup

```bash
# Clone project ke direktori lokal 
$ git clone https://github.com/xXehub/final-supermarket-web

# Masuk ke dir project
$ cd final-supermarket-web

# Install dependencies
$ npm install
$ composer install

# Migrasi data dari seeder ke database
php artisan migrate:fresh --seed

# Run project
$ npm run dev
$ php artisan serve

# The server will initialize in the <http://127.0.0.1:8000>
```

## :gear: Konfigurasi

Copy file .env.example dan ubah nama file menjadi .env lalu sesuaikan degan konfigurasi kalian
<details>
<summary>
 Penjelasan Singkat
</summary>

####

| Usernane | Contoh     | Penjelasan                |
| :-------- | :------- | :------------------------- |
| ` APP_KEY ` | ` base64:Mx6z7+GzDxxrQhnXGeMrjcKmYhIIlHI0q8pKwAyYycI= ` | untuk melakukan enkripsi dan dekripsi data. Ini berfungsi saat Laravel menggunakan fitur enkripsi dan dekripsi, serta dalam proses enkripsi dan dekripsi cookie.  |
| ` APP_URL `| ` http://localhost ` | untuk menentukan URL dasar dari aplikasi Laravel. Ini akan digunakan oleh beberapa fitur Laravel seperti routing |
| ` DB_DATABASE `| `laravel_sakkarepmu` | untuk menentukan nama **database** yang akan digunakan oleh aplikasi|
| ` DB_USERNAME `| ` root ` | untuk menentukan **nama** atau **username** database yang akan digunakan oleh aplikasi default **root**|
| ` DB_PASSWORD `| ` root123 ` | untuk menentukan nama **password** yang akan digunakan oleh aplikasi, Anda harus mengganti **password** dengan password yang sesuai dengan konfigurasi database Anda|
</details>

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_sakkarepmu
DB_USERNAME=root
DB_PASSWORD=root123
```

## :memo: License

This project is licensed under the MIT License. For more details, please refer to the [LICENSE](LICENSE.md) File.

**Authors** : [@xXehub](https://www.github.com/xXehub)

<!-- Made with :heart: by <a href="https://github.com/xXehub" target="_blank">{{YOUR_NAME}}</a>

&#xa0; -->
<!-- 
## :label: Authors

-   [@xXehub](https://www.github.com/xXehub) -->
