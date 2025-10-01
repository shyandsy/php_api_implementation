<?php
namespace App\EnvTest;

class EnvTest{
    private $db_config = [
        'host' => 'mysql8',
        'db' => 'test',
        'user' => 'root',
        'pass' => '12345678',
        'charset' => 'utf8mb4',
    ];
    private $db_dsn = "";
    private $redis_port = 6379;

    public function __construct()
    {
        $this->db_dsn = "mysql:host={$this->db_config['host']};dbname={$this->db_config['db']};charset={$this->db_config['charset']}";
    }

    public function run(){
        $this->testMysql();
        $this->testRedis();
    }

    private function testMysql(){
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ];

        try {
            $pdo = new \PDO($this->db_dsn, $this->db_config["user"], $this->db_config["pass"], $options);
            echo "✅ MySQL Connect Success<br>";
        } catch (PDOException $e) {
            echo "❌ MySQL Connect Failed: " . $e->getMessage() . "<br>";
        }
    }

    private function testRedis(){
        $redis = new \Redis();
        try {
            $redis->connect('redis', $this->redis_port);
            echo "✅ Redis Connect Success<br>";
        } catch (\Exception $e) {
            echo "❌ Redis Connect Failed: " . $e->getMessage() . "<br>";
        }
    }
}