<?php

require "libs/rb.php";
  R::setup( 'mysql:host=localhost;dbname=musstore',
        'root', '' ); 


  session_start();