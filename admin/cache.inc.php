<?php
//是否开启缓冲区，后台专用
define('IS_CACHE',false);
//判断是否开启缓冲区
IS_CACHE ? ob_start() : null;
?>