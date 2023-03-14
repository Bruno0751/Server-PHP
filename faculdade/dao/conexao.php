<?php
class Conexao extends PDO
{

    private static $inst = null;

    public function __construct($bd, $user, $pass)
    {
        parent::__construct($bd, $user, $pass);
    }

    public static function getInstance()
    {
        try {
            if (!isset(self::$inst)) {
                self::$inst = new Conexao("mysql:dbname=db_trabalho;host=localhost", "root", "9320");
            }
            return self::$inst;
        } catch (PDOException $erro) {
            echo "<script>window.alert('Erro ao Conectar');</script>" . $erro;
        }
    }
}
