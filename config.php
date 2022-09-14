<?php

// 接続に必要な情報を定数として定義
define('DSN', 'mysql:host=db;dbname=task_app;charset=utf8');
define('USER', 'task_admin');
define('PASSWORD', '1234');

// doneの状態を定数として定義
define('TASK_NOTYET', 0);
define('TASK_DONE', 1);
