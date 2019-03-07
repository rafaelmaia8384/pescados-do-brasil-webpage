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

    for ($a = 1; $a <= 1473; $a++) {

        $result = $db->dbRead("SELECT * FROM tb_anuncios WHERE id = {$a} LIMIT 1");

        if (is_array($result)) {

            //$files_busca = getFilesListBusca($result[0]['tipo_pescado']);
            //$files_principal = getFilesListPrincipal($result[0]['tipo_pescado']);
            $tipo_pescado = $result[0]['tipo_pescado'];
            $id_anuncio = $result[0]['id_anuncio'];

            $count = rand(2, 10);

            for ($i = 0; $i < $count; $i++) {

                $id_imagem = generateId();
                $img_name = $tipo_pescado . '-' . rand(1, 30) . '.jpg';

                $img = array(

                    'id_imagem'     => $id_imagem,
                    'id_anuncio'    => $id_anuncio,
                    'img_busca'     => $img_name,
                    'img_principal' => $img_name,
                    'tipo_pescado'  => $tipo_pescado,
                    'imagem_excluida' => 0
                );

                $db->dbInsert('tb_anuncios_imagens', $img);
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
