<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-07-04 06:15:09 --> Query error: Column 'phone' cannot be null - Invalid query: INSERT INTO `tbl_address` (`user_id`, `fname`, `lname`, `email`, `phone`, `city`, `state`, `country`, `pincode`, `address`, `gender`) VALUES ('2', 'la', 'sa', 'sa@gmail.com', NULL, 'mzn', 'up', NULL, '251319', 'new delhi', NULL)
ERROR - 2022-07-04 11:06:17 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home1/sarkark2/public_html/brandhypeco/9gates/application/controllers/api/Userapi.php:97) /home1/sarkark2/public_html/brandhypeco/9gates/system/core/Common.php 570
ERROR - 2022-07-04 11:06:17 --> Severity: Compile Error --> Cannot redeclare Userapi::useraddress_post() /home1/sarkark2/public_html/brandhypeco/9gates/application/controllers/api/Userapi.php 97
ERROR - 2022-07-04 11:09:35 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home1/sarkark2/public_html/brandhypeco/9gates/application/controllers/api/Userapi.php:97) /home1/sarkark2/public_html/brandhypeco/9gates/system/core/Common.php 570
ERROR - 2022-07-04 11:09:35 --> Severity: Compile Error --> Cannot redeclare Userapi::useraddress_post() /home1/sarkark2/public_html/brandhypeco/9gates/application/controllers/api/Userapi.php 97
ERROR - 2022-07-04 11:17:33 --> Query error: Column 'pincode' cannot be null - Invalid query: INSERT INTO `tbl_address` (`user_id`, `address`, `fname`, `lname`, `email`, `phone`, `country`, `state`, `city`, `pincode`, `gender`, `longitude`, `latitude`, `geo_location`) VALUES ('158', 'testing', 'ok', 'ok', 'okoko@gmail.com', '9876545432', 'india', 'delhi', 'delhi', NULL, 'M', 'iouei3ncmadsncm,', 'msasncmasnqiurewiuo', 'makdlmf24i9r94w')
