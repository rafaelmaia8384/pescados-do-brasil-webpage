<?php

    require '../app-v1.0/sistema/config.php';
    require '../app-v1.0/sistema/database.php';
    require '../app-v1.0/sistema/feedback.php';

    $fb = new FeedBack();

    if (!empty($_POST['email']) && !empty($_POST['senha'])) {

        $email = $fb->escapeString($_POST['email']);
        $senha = $fb->escapeString($_POST['senha']);

        $result = $fb->dbRead("SELECT id_usuario FROM tb_usuario WHERE email = '{$email}' AND senha = '{$senha}' LIMIT 1");

        if (is_array($result)) {

            $result[0]['formulario'] = file_get_contents('formulario.html');

            $fb->success("Login efetuado.", $result[0]);
        }
        else {

            $fb->error("Email ou senha invalidos.");
        }
    }
    else {

        $fb->error("Email ou senha invalidos.");
    }

?>
