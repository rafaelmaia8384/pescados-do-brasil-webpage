<?php

    require '../app-v1.0/sistema/config.php';
    require '../app-v1.0/sistema/database.php';
    require '../app-v1.0/sistema/feedback.php';

    $fb = new FeedBack();

    if (!empty($_POST['id_anuncio'])    &&
        !empty($_FILES['imagem'])) {

        $id_anuncio = $fb->escapeString($_POST['id_anuncio']);
        $file_name = $fb->escapeString($_FILES['imagem']['name']);

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], "../data/image.jpg")) {

            $fb->success('Imagem enviada');
        }
        else {

            $fb->error(error_get_last()['message']);
        }
    }
    else {

        $fb->error('Erro no preenchimento dos dados: cadastrar-imagem.php');
    }

?>
