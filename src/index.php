<?php
// test config
$host = 'mysql8';        // Docker 网络里的 MySQL 容器名
$db   = 'test'; // 数据库名
$db_user = 'root';          // MySQL 用户
$db_pass = '12345678'; // 密码
$charset = 'utf8mb4';
$db_dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$redis_port = 6379;

// CREATE SCHEMA `test` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci

function test_mysql_redis(string $db_dsn, string $db_user, string $db_pass, int $redis_port){
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    try {
        $pdo = new PDO($db_dsn, $db_user, $db_pass, $options);
        echo "✅ MySQL Connect Success<br>";
    } catch (PDOException $e) {
        echo "❌ MySQL Connect Failed: " . $e->getMessage() . "<br>";
    }

// Redis 测试
    $redis = new Redis();
    try {
        $redis->connect('redis', $redis_port); // Docker 网络里的 Redis 容器名
        echo "✅ Redis Connect Success<br>";
    } catch (Exception $e) {
        echo "❌ Redis Connect Failed: " . $e->getMessage() . "<br>";
    }
}

test_mysql_redis($db_dsn, $db_user,  $db_pass,  $redis_port);
phpinfo();






