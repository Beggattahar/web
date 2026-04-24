<?php
require 'config.php';

$page = $_GET['page'] ?? 'login';

if ($page == 'login') {
    include 'views/login.php';
}