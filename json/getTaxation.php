<?php

require "../app/define.php";
require BASE;
//require BASE;
//require BASE;

echo json_encode(DB::results("SELECT * FROM taxation"));