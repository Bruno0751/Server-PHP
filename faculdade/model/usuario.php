<?php
class Usuario
{

    private $idUsuario;
    private $nome;
    private $login;
    private $senha;

    public function __construct()
    {
    }
    public function __destruct()
    {
    }

    public function __get($a)
    {
        return $this->$a;
    }
    public function __set($a, $v)
    {
        $this->$a = $v;
    }

    public function __toString()
    {
        return nl2br("nome : $this->nome
                    login: $this->login
                    senha: $this->senha");
    }
}
