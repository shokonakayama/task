<?php

// 設定ファイルを読み込む
require_once __DIR__ . '/config.php';

// 接続処理を行う関数
function connect_db()
{
    // try ~ catch 構文
    try {
        return new PDO(
            DSN,
            USER,
            PASSWORD,
            [PDO::ATTR_ERRMODE =>
            PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        // 接続がうまくいかない場合こちらの処理が実行される
        echo $e->getMessage();
        exit;
    }
}

// エスケープ処理を行う関数
function h($str)
{
    // ENT_QUOTES: シングルクオートとダブルクオートを共に変換する。
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// タスク登録時のバリデーション
function insert_validate($title)
{
    // 初期化
    $errors = [];

    if (empty($title)) {
        $errors[] = MSG_TITLE_REQUIRED;
    }

    return $errors;
}

// タスク登録
function insert_task($title)
{
    // データベースに接続
    $dbh = connect_db();

    // レコードを追加
    $sql = <<<EOM
    INSERT INTO
        tasks
        (title)
    VALUES
        (:title)
    EOM;

    // プリペアドステートメントの準備
    $stmt = $dbh->prepare($sql);

    // パラメータのバインド
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);

    // プリペアドステートメントの実行
    $stmt->execute();
}

function find_task_by_done($status)
{
    $dbh = connect_db();

    /* タスク照会
---------------------------------------------*/
    // done を抽出条件に指定してデータを取得
    $sql = <<<EOM
    SELECT
        *
    FROM
        tasks
    WHERE
        done = :status;
    EOM;

    // プリペアドステートメントの準備
    $stmt = $dbh->prepare($sql);

    // パラメータのバインド
    $stmt->bindValue(':status', $status, PDO::PARAM_INT);

    // プリペアドステートメントの実行
    $stmt->execute();

    // 結果の取得
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
