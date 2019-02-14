<?php

    ini_set('max_execution_time', 900);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    set_time_limit(0);

    date_default_timezone_set('America/Araguaina');

    require 'sistema/config.php';
    require 'sistema/database.php';
    require 'sistema/feedback.php';

    $fb = new FeedBack();

    $handle = fopen("palavras.txt", "r");

    if ($handle) {

        $done = false;

        while (!$done) {

            $query = '';

            for ($a = 0; $a < 100; $a++) {

                $line = fgets($handle);

                if ($line === false) {

                    $done = true;

                    break;
                }
                else {

                    if (strlen($line) < 4) continue;

                    $word = preg_replace("/[^A-Za-z]/", '', $line);
                    $word = strtolower($word);

                    $query .= "INSERT INTO tb_palavras ( palavra ) VALUES ( '{$word}' );\n";
                }
            }

            $fb->dbExecuteMultiQuery($query);
        }

        fclose($handle);
    }

    $fb->success('ok');

    /*$fb = new FeedBack();

    $result = $fb->dbRead("SELECT * FROM tb_anuncios WHERE id_anuncio > 1");

    if (is_array($result)) {

        require 'sistema/metaphonePTBR.php';

		$metaphone = new Metaphone();

		//$nome_completo_soundex = $metaphone->getPhraseMetaphone($nome_completo);

        for ($a = 0; $a < count($result); $a++) {

            $palavras_chave = 'de da das do dos em ';

            if ($result[$a]['tipo_pescado'] == 1) {

                $palavras_chave .= 'camarao ';
            }
            elseif ($result[$a]['tipo_pescado'] == 2) {

                $palavras_chave .= 'caranguejo ';
            }
            elseif ($result[$a]['tipo_pescado'] == 3) {

                $palavras_chave .= 'lagosta ';
            }
            elseif ($result[$a]['tipo_pescado'] == 4) {

                $palavras_chave .= 'lula ';
            }
            elseif ($result[$a]['tipo_pescado'] == 5) {

                $palavras_chave .= 'mexilhao ';
            }
            elseif ($result[$a]['tipo_pescado'] == 6) {

                $palavras_chave .= 'ostra ';
            }
            elseif ($result[$a]['tipo_pescado'] == 7) {

                $palavras_chave .= 'peixe ';
            }
            elseif ($result[$a]['tipo_pescado'] == 8) {

                $palavras_chave .= 'polvo ';
            }

            if ($result[$a]['tipo_agua'] == 1) {

                $palavras_chave .= 'agua doce ';
            }
            elseif ($result[$a]['tipo_agua'] == 2) {

                $palavras_chave .= 'agua salobra ';
            }
            else {

                $palavras_chave .= 'agua salgada ';
            }

            if ($result[$a]['fresco_congelado'] == 1) {

                $palavras_chave .= 'fresco ';
            }
            elseif ($result[$a]['fresco_congelado'] == 2) {

                $palavras_chave .= 'congelado ';
            }
            else{

                $palavras_chave .= 'salgado ';
            }

            if ($result[$a]['possui_selo_inspecao'] > 1) {

                $palavras_chave .= 'selo ';
            }

            $palavras_chave .= $result[$a]['municipio_produto'];

            $codigo_anuncio = $result[$a]['codigo_anuncio'];
            $palavras_chave = $metaphone->getPhraseMetaphone($palavras_chave);

            $fb->dbExecute("UPDATE tb_anuncios SET palavras_chave_soundex = '{$palavras_chave}' WHERE codigo_anuncio = {$codigo_anuncio} LIMIT 1");
        }
    }

    $fb->success('DB OK');*/

    /*$result = $fb->dbRead("SELECT * FROM tb_anuncios WHERE id_anuncio > 0");

    if (is_array($result)) {

        for ($a = 0; $a < count($result); $a++) {

            $codigo_anuncio = $result[$a]['codigo_anuncio'];
            $number = rand(1, 30);
            $img = $result[$a]['tipo_pescado'] . '-' . $number . '.jpg';

            $fb->dbExecute("UPDATE tb_anuncios SET img_busca = '{$img}', img_principal = '{$img}' WHERE codigo_anuncio = {$codigo_anuncio} LIMIT 1");
        }
    }

    $fb->success('DB OK');*/

    /*$result = $fb->dbRead("SELECT tipo_pescado, codigo_anuncio FROM tb_anuncios WHERE id_anuncio > 0");

    if (is_array($result)) {

        $count = count($result);

        for ($a = 0; $a < $count; $a++) {

            $codigo_anuncio = $result[$a]['codigo_anuncio'];
            $times = rand(1, 5);

            for ($b = 0; $b < $times; $b++) {

                $number = rand(1, 30);

                $img = $result[$a]['tipo_pescado'] . '-' . $number . '.jpg';

                $imagem = array (

                    'codigo_anuncio'    => $codigo_anuncio,
                    'img_busca'         => $img,
                    'img_principal'     => $img
                );

                $fb->dbInsert('tb_imagens', $imagem);
            }
        }
    }

    $fb->success('DB OK');*/

    /*for ($a = 0; $a < 1500; $a++) {

        $codigo_anuncio = generateId();
        $nome_anunciante = readable_random_string(rand(6, 16));
        $tipo_pescado = rand(1, 9);
        $tipo_agua = rand(1, 2);
        $fresco_congelado = rand(1, 3);
        $possui_selo_inspecao = rand(1, 4);
        $total_disponivel = rand(1, 11);
        $faz_entrega = rand(1, 11);
        $uf_produto = rand(1, 27);
        $municipio_produto = readable_random_string(rand(6, 16));
        $titulo_produto = phrase_generator(rand(6, 12));
        $descricao = phrase_generator(rand(30, 100));
        $falar_com = phrase_generator(rand(1, 3));
        $anuncio_pago = rand(1, 4);

        $anuncio = array(

            'id_anunciante'         => 1,
            'id_publicante'         => 0,
            'codigo_anuncio'        => $codigo_anuncio,
            'nome_anunciante'       => $nome_anunciante,
            'tipo_pescado'          => $tipo_pescado,
            'tipo_agua'             => $tipo_agua,
            'fresco_congelado'      => $fresco_congelado,
            'possui_selo_inspecao'  => $possui_selo_inspecao,
            'total_disponivel'      => $total_disponivel,
            'faz_entrega'           => $faz_entrega,
            'uf_produto'            => $uf_produto,
            'municipio_produto'     => $municipio_produto,
            'titulo'                => $titulo_produto,
            'descricao'             => $descricao,
            'telefone'              => $codigo_anuncio,
            'falar_com'             => $falar_com,
            'anuncio_pago'          => $anuncio_pago
        );

        $fb->dbInsert('tb_anuncios', $anuncio);
    }

    $fb->success('DB OK');

    function generateId() {

        return hexdec(generateHexNumberId());
    }

    function generateHexNumberId() {

        $characters = '0123456789ABCDEF';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < 8; $i++) {

            if ($i == 0) $randomString .= $characters[rand(1, $charactersLength - 1)];
            else $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    function phrase_generator($num_words) {

        $phrase = "";
        $count = 0;

        while ($count < $num_words) {

            $phrase .= readable_random_string(rand(3, 16)) . ' ';

            $count++;
        }

        return $phrase;
    }

    function readable_random_string($length = 6) {

        $string     = '';
        $vowels     = array("a","e","i","o","u");
        $consonants = array(
            'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm',
            'n', 'p', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'
        );
        // Seed it
        srand((double) microtime() * 1000000);
        $max = $length/2;
        for ($i = 1; $i <= $max; $i++)
        {
            $string .= $consonants[rand(0,19)];
            $string .= $vowels[rand(0,4)];
        }
        return $string;
    }*/

?>
