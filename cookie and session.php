<?php
session_start();
session_destroy();
setcookie(name,value,time()+3600);
