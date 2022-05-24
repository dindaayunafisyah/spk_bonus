**Deskripsi Sistem Informasi**

Sistem Informasi Website Pelabuhan Kapal sederhana ini merupakan sistem infromasti yang digunakan untuk Mendaftarkan Kapal yang datang ke pelabuhan.

**Yang Dibutuhkan :**
1. XAMPP 7.2.28 atau lebih baru
2. PHP versi 5.6 atau lebih
3. Text Editor seperti Visual Studio Code atau lainnya
4. Template SB Admin 2 Bootstrap
5. CodeIgniter versi 3.1.11

**Konfigurasi :**
1. pertama nyalakan XAMPP agar dapat menjalankan localhost dan phpmyadmin
2. Kemudian atur konfigurasi sebagai berikut
pada file config/autoload.php

```
	defined('BASEPATH')  OR  exit('No direct script access allowed');
	$autoload['packages']  =  array();
	$autoload['libraries']  =  array('database', 'session');
	$autoload['drivers']  =  array();
	$autoload['helper']  =  array('url');
	$autoload['config']  =  array();
	$autoload['language']  =  array();
	$autoload['model']  =  array();
```

pada file config/config.php
```
	defined('BASEPATH')  OR  exit('No direct script access allowed');
	$config['base_url']  =  'http://localhost/TugasWeb/';
	$config['index_page']  =  ''; //dikosongkan karena kita sudah menggunakan .htaccess untuk menghilangkan index.php untuk penulisan url lebih mudah
```

pada file config/database.php
```
$autoload['libraries'] = array('database', 'form_validation', 'session');
$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'maritim', //nama database
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
```

pada file config/routes.php
```
$route['default_controller']  =  'c_login';  //kontroller default
$route['404_override']  =  '';
$route['translate_uri_dashes']  =  FALSE;
```

**Implementasi :**
Masukkan link http://localhost/TugasWeb/admin/C_kapal/tambah untuk mulai menjalankan website
