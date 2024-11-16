<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

INFO - 2021-03-25 14:26:31 --> Config Class Initialized
INFO - 2021-03-25 14:26:31 --> Hooks Class Initialized
DEBUG - 2021-03-25 14:26:32 --> UTF-8 Support Enabled
INFO - 2021-03-25 14:26:32 --> Utf8 Class Initialized
INFO - 2021-03-25 14:26:32 --> URI Class Initialized
DEBUG - 2021-03-25 14:26:32 --> No URI present. Default controller set.
INFO - 2021-03-25 14:26:32 --> Router Class Initialized
INFO - 2021-03-25 14:26:32 --> Output Class Initialized
INFO - 2021-03-25 14:26:32 --> Security Class Initialized
DEBUG - 2021-03-25 14:26:32 --> Global POST, GET and COOKIE data sanitized
INFO - 2021-03-25 14:26:32 --> Input Class Initialized
INFO - 2021-03-25 14:26:32 --> Language Class Initialized
INFO - 2021-03-25 14:26:33 --> Loader Class Initialized
INFO - 2021-03-25 14:26:33 --> Helper loaded: url_helper
INFO - 2021-03-25 14:26:33 --> Helper loaded: file_helper
INFO - 2021-03-25 14:26:34 --> Database Driver Class Initialized
ERROR - 2021-03-25 14:26:34 --> Severity: Warning --> mysqli::real_connect(): (HY000/1049): Unknown database 'tinf975d_tindatdai' D:\xampp\htdocs\mysite\system\database\drivers\mysqli\mysqli_driver.php 201
ERROR - 2021-03-25 14:26:34 --> Unable to connect to the database
INFO - 2021-03-25 14:26:34 --> Language file loaded: language/english/db_lang.php
INFO - 2021-03-25 14:45:18 --> Config Class Initialized
INFO - 2021-03-25 14:45:18 --> Hooks Class Initialized
DEBUG - 2021-03-25 14:45:18 --> UTF-8 Support Enabled
INFO - 2021-03-25 14:45:19 --> Utf8 Class Initialized
INFO - 2021-03-25 14:45:19 --> URI Class Initialized
DEBUG - 2021-03-25 14:45:19 --> No URI present. Default controller set.
INFO - 2021-03-25 14:45:19 --> Router Class Initialized
INFO - 2021-03-25 14:45:19 --> Output Class Initialized
INFO - 2021-03-25 14:45:19 --> Security Class Initialized
DEBUG - 2021-03-25 14:45:19 --> Global POST, GET and COOKIE data sanitized
INFO - 2021-03-25 14:45:19 --> Input Class Initialized
INFO - 2021-03-25 14:45:19 --> Language Class Initialized
INFO - 2021-03-25 14:45:19 --> Loader Class Initialized
INFO - 2021-03-25 14:45:19 --> Helper loaded: url_helper
INFO - 2021-03-25 14:45:19 --> Helper loaded: file_helper
INFO - 2021-03-25 14:45:19 --> Database Driver Class Initialized
DEBUG - 2021-03-25 14:45:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
INFO - 2021-03-25 14:45:19 --> Session: Class initialized using 'files' driver.
INFO - 2021-03-25 14:45:19 --> Controller Class Initialized
DEBUG - 2021-03-25 14:45:20 --> Session class already loaded. Second attempt ignored.
INFO - 2021-03-25 14:45:20 --> Model Class Initialized
INFO - 2021-03-25 14:45:20 --> Model Class Initialized
INFO - 2021-03-25 14:45:20 --> Model Class Initialized
INFO - 2021-03-25 14:45:20 --> Model Class Initialized
INFO - 2021-03-25 14:45:20 --> Helper loaded: seo_url_helper
INFO - 2021-03-25 14:45:20 --> Helper loaded: text_helper
INFO - 2021-03-25 14:45:20 --> Helper loaded: my_date_helper
INFO - 2021-03-25 14:45:20 --> Model Class Initialized
INFO - 2021-03-25 14:45:21 --> Model Class Initialized
INFO - 2021-03-25 14:45:21 --> Model Class Initialized
INFO - 2021-03-25 14:45:21 --> Model Class Initialized
INFO - 2021-03-25 14:45:21 --> Helper loaded: form_helper
DEBUG - 2021-03-25 14:45:21 --> Cache class already loaded. Second attempt ignored.
ERROR - 2021-03-25 14:45:21 --> Query error: Table 'tinf975d_tindatdai.product' doesn't exist - Invalid query: select p.CityID, ct.CityName, p.CategoryID, c.CatName from product p inner join category c on p.categoryid = c.categoryid inner join city ct on ct.cityid = p.cityid where ct.Hot = 1 group by p.cityid, p.categoryid order by count(p.productid) desc, c.CatName asc
INFO - 2021-03-25 14:45:21 --> Language file loaded: language/english/db_lang.php
