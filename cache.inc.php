<?php
//是否开启缓冲区，前台专用
define('IS_CACHE',true);
//判断是否开启缓冲区
IS_CACHE ? ob_start() : null;
?>