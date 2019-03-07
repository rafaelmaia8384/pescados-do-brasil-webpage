<?php

    if (!empty($_POST['id_anuncio'])) {

        $id_anuncio = $db->dbEscapeString($_POST['id_anuncio']);

        $result = $db->dbRead("SELECT * FROM tb_anuncios_imagens WHERE id_anuncio = {$id_anuncio} AND imagem_excluida = 0");

        if (is_array($result)) {

            $imagens = array('Resultado' => $result);

            $db->dbSuccess('Imagens encontradas.', $imagens);
        }
        else {

            $db->dbError('Nenhuma imagem encontrada.');
        }
    }
    else {

        $db->dbError('Acesso negado.');
    }

?>
