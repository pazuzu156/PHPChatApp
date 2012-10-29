<?php

@session_start();

define('SALT', base64_encode('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890'));
define('PEPPER', base64_encode(SALT));
define('SPCODE', SALT . PEPPER);

require 'classes/Core.class.php';
require 'classes/Register.class.php';
require 'classes/Login.class.php';
require 'classes/Chat.class.php';

?>