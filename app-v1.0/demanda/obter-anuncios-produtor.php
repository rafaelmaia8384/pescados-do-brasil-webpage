<?php

    if (!empty($_POST['index'])) {

        $index = $fb->escapeString($_POST['index']);

        if ($index < 1) $index= 1;

        $search_limit = 5; //5 anuncios por vez
        $limit = ($index - 1) * $search_limit;

        $result = $fb->dbRead("SELECT * FROM tb_anuncios WHERE anuncio_excluido = 0 AND anuncio_pago = 4 ORDER BY data_cadastro DESC LIMIT {$limit}, {$search_limit}");

        if (is_array($result)) {

            $divs = '';

            for ($a = 0; $a < count($result); $a++) {

                $tipo_pescado = '';
                $tipo_agua = '';
                $total_disponivel = '';

                if ($result[$a]['tipo_pescado'] == 1) {

                    $tipo_pescado = 'Camarão';
                }
                elseif ($result[$a]['tipo_pescado'] == 2) {

                    $tipo_pescado = 'Caranguejo';
                }
                elseif ($result[$a]['tipo_pescado'] == 3) {

                    $tipo_pescado = 'Lagosta';
                }
                elseif ($result[$a]['tipo_pescado'] == 4) {

                    $tipo_pescado = 'Lula';
                }
                elseif ($result[$a]['tipo_pescado'] == 5) {

                    $tipo_pescado = 'Mexilhão';
                }
                elseif ($result[$a]['tipo_pescado'] == 6) {

                    $tipo_pescado = 'Ostra';
                }
                elseif ($result[$a]['tipo_pescado'] == 7) {

                    $tipo_pescado = 'Peixe';
                }
                elseif ($result[$a]['tipo_pescado'] == 8) {

                    $tipo_pescado = 'Polvo';
                }
                else {

                    $tipo_pescado = 'Outros';
                }

                if ($result[$a]['tipo_agua'] == 1) {

                    $tipo_agua = 'Água doce';
                }
                elseif ($result[$a]['tipo_agua'] == 2) {

                    $tipo_agua = 'Água salobra';
                }
                else {

                    $tipo_agua = 'Água salgada';
                }

                if ($result[$a]['total_disponivel'] == 1) {

                    $total_disponivel = '> 1 kg';
                }
                elseif ($result[$a]['total_disponivel'] == 2) {

                    $total_disponivel = '> 5 kg';
                }
                elseif ($result[$a]['total_disponivel'] == 3) {

                    $total_disponivel = '> 10 kg';
                }
                elseif ($result[$a]['total_disponivel'] == 4) {

                    $total_disponivel = '> 25 kg';
                }
                elseif ($result[$a]['total_disponivel'] == 5) {

                    $total_disponivel = '> 50 kg';
                }
                elseif ($result[$a]['total_disponivel'] == 6) {

                    $total_disponivel = '> 100 kg';
                }
                elseif ($result[$a]['total_disponivel'] == 7) {

                    $total_disponivel = '> 200 kg';
                }
                elseif ($result[$a]['total_disponivel'] == 8) {

                    $total_disponivel = '> 500 kg';
                }
                elseif ($result[$a]['total_disponivel'] == 9) {

                    $total_disponivel = '> 1000 kg';
                }
                elseif ($result[$a]['total_disponivel'] == 10) {

                    $total_disponivel = '> 2500 kg';
                }
                else {

                    $total_disponivel = '> 5000 kg';
                }

                $divs .= '<div style="float: left; margin-left: 10px;"><div class="img_container"><img src="data/busca/'. $result[$a]['img_busca'] .'" height="150" /><div class="img_text"><br /><br /><b>'. $tipo_pescado .'</b><br />'. $tipo_agua .'<br />'. $total_disponivel .'</div></div></div>';
            }

            $content = base64_encode($divs);

            usleep(500000);

            $fb->success($content);
        }
        else {

            $fb->success(base64_encode('Resultado nao encontrado.'));
        }
    }
    else {

        $fb->success(base64_encode('Erro ao obter anúncios produtor.'));
    }

?>
