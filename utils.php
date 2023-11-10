<?php

    session_start();
    require_once('./utils.php');

    if (is_user_authenticated()) {
      redirect('admin.php');
      die();
    }
?>