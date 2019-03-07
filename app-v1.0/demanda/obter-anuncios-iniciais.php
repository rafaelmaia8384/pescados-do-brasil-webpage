<?php

    if (!empty($_POST['index'])) {

        $stack = array();

        $result = $db->dbRead("SELECT * FROM tb_anuncios WHERE anuncio_excluido = 0 AND anuncio_pago = 4 ORDER BY data_registro DESC LIMIT 6");

        if (is_array($result)) {

            array_push($stack, $result);
        }

        $result = $db->dbRead("SELECT * FROM tb_anuncios WHERE anuncio_excluido = 0 AND anuncio_pago = 3 ORDER BY data_registro DESC LIMIT 6    ");

        if (is_array($result)) {

            array_push($stack, $result);
        }

        $result = $db->dbRead("SELECT * FROM tb_anuncios WHERE anuncio_excluido = 0 AND anuncio_pago = 2 ORDER BY data_registro DESC LIMIT 8");

        if (is_array($result)) {

            array_push($stack, $result);
        }

        if (count($stack) > 0) {

            $done = array('Resultado' => $stack);

            $db->dbSuccess('Resultados encontrados.', $done);
        }
        else {

            $db->dbError('Nenhum resultado.');
        }
    }
    else {

        $db->dbError('Acesso negado.');
    }

?>
