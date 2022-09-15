<?php

// 接続に必要な情報を定数として定義
define('DSN', 'mysql:host=db;dbname=task_app;charset=utf8');
define('USER', 'task_admin');
define('PASSWORD', '1234');

// エラーメッセージを定数として定義
define('MSG_TITLE_REQUIRED', 'タスク名を入力してください');

// doneの状態を定数として定義
define('TASK_NOTYET', 0);
define('TASK_DONE', 1);
