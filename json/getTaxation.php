<?php

require "../app/define.php";
require BASE;

echo json_encode(DB::results("SELECT * FROM taxation"));