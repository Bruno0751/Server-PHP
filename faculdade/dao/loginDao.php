<?php
require 'conexao.php';
class LoginDao
{

    private $conexao = null;

    public function __construct()
    {
        $this->conexao = Conexao::getInstance();
    }

    public function __destruct()
    {
    }

    public function cadastrarUsuario($user)
    {
        try {
            $stat = $this->conexao->prepare("INSERT INTO bd_php_final.usuarios VALUES(NULL, ?, ?, ?, ?);");
            $stat->bindValue(1, $user->nome);
            $stat->bindValue(2, $user->senha);
            $stat->bindValue(3, $user->login);

            $stat->execute();
        } catch (PDOException $erro) {
            echo "Erro ao Cadastrar Usuario " . $erro;
        }
    }

    public function buscarUsuarios()
    {
        try {
            $stat = $this->conexao->query("SELECT * FROM db_trabalho.tb_login;");
            $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Usuario');
            return $array;
        } catch (PDOException $erro) {
            echo "<script>window.alert('Erro ao Buscar');</script>" . $erro;
        }
    }

    public function verificarUsuario($u)
    {
        try {
            $stat = $this->conexao->prepare("SELECT * FROM db_trabalho.tb_login WHERE nome = ? and senha = ?");

            $stat->bindValue(1, $u->login);
            $stat->bindValue(2, $u->senha);
            //echo $u;
            $stat->execute();

            $usuario = null;
            $usuario = $stat->fetchObject('Usuario');
            return $usuario;
        } catch (PDOException $e) {
            echo "Erro ao buscar usuarios! " . $e;
        }
    }
}
