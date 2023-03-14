<?php
  session_start();
  ob_start();
  include_once 'util/helper.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Um Site Para um Projeto Final de PHP Esta é Uma Página de Cadastro de Cliente</title>
    <meta http-equiv="Content-Type" content="text/php; charset=UTF-8">
    <meta name="author" content="Bruno Gressler da Silveira">
    <meta name="description" content="Um Site Feito Inteiramente e Exclusivamente Para Registros em Uma Academia, Onde Conterá Registros de Funcionários, Clientes e Também Professores, um Site Especializado em PHP e Também Banco de Dados Gratuito.">
    <meta name="keywords" content="Cadastro, Professor, Consulta, Funcionario, Cliente">
    <meta name="viewport" content="width=device-width,intial-scale=1,maximum-scale=1">
    <!-- <link rel="icon" href="image/icone.png"> -->
    <!-- <link  href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <script src="vendor/components/jquery/jquery.min.js"></script> -->
    <!-- <link rel="stylesheet" type="text/css" href="style/estilos.css"> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script> -->
    <!-- <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script> -->
  </head>
  <body>
    
    <div class="center container-fluid ">
      <header class="jumbotron container-fluid head">
        <h1 >Verificar</h1>
      </header>
      <nav class="navbar container-fluid menu">
        <ul class="nav navbar-nav ">
          <li class="nav-item active"><a class="nav-link" href="cadastrar-usuarios.php">Ainda não tem conta?</a></li>
          <li class="nav-item active"><a class="nav-link" href="buscar-usuarios.php">Registros de usuários</a></li>
          <?php
            if (isset($_SESSION['privateUser'])) {
          ?>
          <!-- ESTIVER LOGADO -->
              <li class="nav-item active"><a class="nav-link" href="buscar-usuarios.php">Registros de usuários</a></li>
          <?php
            }
          ?>
        </ul>
      </nav>
      <?php
        echo isset($_SESSION['msg']) ? Helper::alert($_SESSION['msg']) : "";
        unset($_SESSION['msg']);
      ?>
      <?php
        if(!isset($_SESSION['privateUser'])){
      ?>
      <!-- SE NÃO ESTIVER LOGADO -->
          <section class="container-fluid">
          <h2 style="display: none;">index</h2>
            <form name="login" method="post" action="">
              <div class="form-group">
                <input type="text" name="txtlogin" placeholder="Login" class="form-control">
              </div>
              <div class="form-group">
                <input type="password" name="txtsenha" placeholder="Digite sua senha" class="form-control">
              </div>
              <div class="form-group">
                <input type="submit" name="entrar" value="Entrar" class="btn btn-primary">
              </div>
            </form>
          </section>
      <?php
        }else{
          include_once "controller/login.php";
          $u = unserialize($_SESSION['privateUser']);
          echo "<h2>Olá {$u->nome}, seja bem vindo!</h2>";
      ?>
      <form name="deslogar" method="post" action="">
        <div class="form-group">
          <input type="submit" name="deslogar" value="Sair" class="btn btn-primary">
        </div>
      </form>
      <?php
          if(isset($_POST['deslogar'])){
            unset($_SESSION['privateUser']);
            header("location:index.php");
          }
      ?>
      <?php
        }
      ?>
      <!-- CONTROLLER -->
      <?php
        if(isset($_POST['entrar'])){
          include 'model/usuario.php';
          include 'dao/loginDao.php';
          //include 'util/seguranca.class.php';

          $u = new Usuario();

          $u->login = $_POST['txtlogin'];
          $u->senha = $_POST['txtsenha'];

          $uDAO = new LoginDao();
          $usuario = $uDAO->verificarUsuario($u);

          if($usuario == null){
            echo "<h2>Usuário/senha inválido(s)!</h2>";
          }else{
            $_SESSION['privateUser'] = serialize($usuario);
            header("location:index.php");
            echo "logado";
          }
        }
      ?>
    </div>
  </body>
</html>
