<?php
require "app/start.php";


echo "<h3> Sistema Mercado </h3>";


echo "<pre>";
var_dump(
    DB::results("SELECT * from product;")
        );
/*var_dump(
    DB::results("SELECT table_name 
FROM information_schema.tables
WHERE table_schema='public'
AND table_type='BASE TABLE';")
        );*/
echo "</pre>";

