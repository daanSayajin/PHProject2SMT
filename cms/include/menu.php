<?php
    if (!file_exists(include_once('../db/conexao.php')))
        include_once('../db/conexao.php');

    if (!isset($_SESSION))
        session_start();

    if (!isset($_SESSION['username'])) 
        header('location:../');
    
    if (isset($_GET['action']) && strtolower($_GET['action']) === 'logout') {
        session_destroy();
        header('location:../');
    }
?>

<nav id="cms-menu">
    <div class="content center">
        <ul>
            <?php
            $conexao = conexao_mysql();
            $sql = 'SELECT * FROM niveis WHERE id=' . $_SESSION['id_level'] . ';';
            $select = mysqli_query($conexao, $sql);
        
            if ($rs_user = mysqli_fetch_array($select)) {
                if ($rs_user['adm_conteudo']) { ?>
                    <li>
                        <a href="./adm_conteudo.php">
                            <img src="./img/content.png" alt="Ícone conteúdo" />
                            Administração de Conteúdo 
                        </a>   
                    </li>
                <?php }

                if ($rs_user['adm_contato']) { ?>
                    <li> 
                        <a href="./adm_contato.php">
                            <img src="./img/contact.jpg" alt="Ícone contato" />
                            Administração Fale Conosco
                        </a>
                    </li>
                <?php }

                if ($rs_user['adm_usuarios']) { ?>
                    <li>
                        <a href="./adm_usuarios.php">
                            <img src="./img/users.svg" alt="Ícone usuários" />
                            Administração de Usuários 
                        </a> 
                    </li>
                <?php }
            } ?>
        </ul>

        <div>
            <header> 
                Bem-vindo, <strong> <?=$_SESSION['username']?> </strong>
            </header>
    
            <footer>
                <a href="?action=logout" onclick="return confirm('Deseja realmente sair?');"> Logout </a>
            </footer>
        </div>
    </div>
</nav>