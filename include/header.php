<?php
    if (!file_exists(include_once('./db/conexao.php')))
        include_once('./db/conexao.php');

    if (!isset($_SESSION))
        session_start();

    if (isset($_POST['btn_submit'])) {
        $email = $_POST['txt_email'];
        $password = $_POST['txt_password'];
    
        $conexao = conexao_mysql();
        $sql = 'SELECT * FROM usuarios;';
        $select = mysqli_query($conexao, $sql);

        while ($rs_user = mysqli_fetch_array($select)) {
            if ($rs_user['status']) {
                if ($email === $rs_user['email'] && $password === $rs_user['senha']) {
                    $_SESSION['id_level'] = $rs_user['id_nivel'];
                    $_SESSION['username'] = $rs_user['nome'];
                    header('location:./cms/');
                }
            }
        }

        echo("<script>alert('Login e/ou senha inválido!');</script>");
    }
?>

<header>
    <div class="conteudo center">
        <div id="area_logo">
            <a href="index.php">
                <div id="logo">
                    <img src="img/logo.png" alt="Frajola's Logo">    
                </div>
            </a>
        </div>

        <!-- Menu de navegação do site -->
        <nav id="area_menu">
            <ul id="menu">  
                <li class="menu_itens"> <a href="promocoes.php"> PROMOÇÕES </a> </li>
                <li class="menu_itens"> <a href="produto_mes.php"> PRODUTO DO MÊS </a> </li> 
                <li class="menu_itens"> <a href="curiosidades.php"> CURIOSIDADES </a> </li>
                <li class="menu_itens"> <a href="filiais.php"> NOSSAS LOJAS </a> </li>
                <li class="menu_itens"> <a href="sobre.php"> SOBRE A EMPRESA </a> </li>
                <li class="menu_itens"> <a href="contato.php"> ENTRE EM CONTATO </a> </li>
            </ul>
        </nav>

        <!-- Área de login -->
        <div id="area_login">
            <form name="frm_login" method="post" action="#">
                <div id="lgn">
                    <label for="txt_email">
                        E-mail  
                    </label>

                     <input type="email" name="txt_email" value="" id="txt_email" class="txt" required>
                </div>

                <div id="pass">
                    <label for="txt_password">
                        Password
                    </label>

                    <input type="password" name="txt_password" value="" id="txt_password" class="txt" required>
                </div>

                <input type="submit" name="btn_submit" value="OK" class="btn">
            </form>
        </div>
    </div>
</header>	