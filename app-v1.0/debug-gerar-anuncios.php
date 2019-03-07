<?php

    ini_set('max_execution_time', 900);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    error_reporting(E_ALL);
    set_time_limit(0);

    date_default_timezone_set('America/Araguaina');

    require 'sistema/Config.php';
    require 'sistema/Database.php';

    $db = new DataBase();

    for ($a = 1; $a <= 500; $a++) {

        $result = $db->dbRead("SELECT * FROM tb_anunciantes WHERE id = {$a} LIMIT 1");

        if (is_array($result)) {

            $id_anunciante = $result[0]['id_anunciante'];
            $count = rand(1, 5);

            for ($i = 0; $i < $count; $i++) {

                $tipo_pescado = rand(1, 9);

                $img_name = $tipo_pescado . '-' . rand(1, 30) . '.jpg';

                //$files_busca = getFilesListBusca($tipo_pescado);
                //$files_principal = getFilesListBusca($tipo_pescado);

                $id_anuncio = generateId();
                $img_busca = $img_name;
                $img_principal = $img_name;
                $tipo_agua = rand(1, 3);
                $fresco_congelado = rand(1, 5);
                $possui_selo_inspecao = rand(1, 4);
                $total_disponivel = rand(1, 6);
                $faz_entrega = rand(1, 2);
                $uf_produto = rand(1, 27);
                $produto_preco = rand(3000, 10000);
                $produto_unidade = rand(1, 2);
                $municipio_produto = readable_random_string(rand(6, 16));
                $titulo_produto = phrase_generator(rand(6, 12));
                $descricao = phrase_generator(rand(30, 100));
                $falar_com = phrase_generator(rand(1, 3));
                $anuncio_pago = rand(1, 4);
                $telefone = generateId();

                $anuncio = array(

                    'id_anuncio'            => $id_anuncio,
                    'id_anunciante'         => $id_anunciante,
                    'img_busca'             => $img_busca,
                    'img_principal'         => $img_principal,
                    'tipo_pescado'          => $tipo_pescado,
                    'tipo_agua'             => $tipo_agua,
                    'armazenamento'         => $fresco_congelado,
                    'possui_selo_inspecao'  => $possui_selo_inspecao,
                    'total_disponivel'      => $total_disponivel,
                    'faz_entrega'           => $faz_entrega,
                    'produto_uf'            => $uf_produto,
                    'produto_municipio'     => $municipio_produto,
                    'produto_preco'         => $produto_preco,
                    'produto_unidade'       => $produto_unidade,
                    'titulo'                => $titulo_produto,
                    'titulo_soundex'        => 'null',
                    'descricao'             => $descricao,
                    'descricao_soundex'     => 'null',
                    'telefone'              => $telefone,
                    'falar_com'             => $falar_com,
                    'anuncio_pago'          => $anuncio_pago,
                    'anuncio_excluido'      => 0
                );

                $db->dbInsert('tb_anuncios', $anuncio);
            }
        }
    }

    $db->dbSuccess('DB OK');

    function getFilesListBusca($tipo_pescado) {

        return scandir('../data/'.getFolderByNumber($tipo_pescado).'/busca/');
    }

    function getFilesListPrincipal($tipo_pescado) {

        return scandir('../data/'.getFolderByNumber($tipo_pescado).'/principal/');
    }

    function getFolderByNumber($num) {

        $folder = array(

            '1'         => 'camarao',
            '2'         => 'caranguejo',
            '3'         => 'lagosta',
            '4'         => 'lula',
            '5'         => 'mexilhao',
            '6'         => 'ostra',
            '7'         => 'peixe',
            '8'         => 'polvo',
            '9'         => 'outros'
        );

        return $folder[$num];
    }

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
        
        srand((double) microtime() * 1000000);
        $max = $length/2;

        for ($i = 1; $i <= $max; $i++) {

            $string .= $consonants[rand(0,19)];
            $string .= $vowels[rand(0,4)];
        }
        return $string;
    }

?>
