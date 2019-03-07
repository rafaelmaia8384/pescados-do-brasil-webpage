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

    for ($a = 0; $a < 500; $a++) {

        $id_anunciante = generateId();
        $nome = phrase_generator(rand(2, 5));
        $descricao = phrase_generator(rand(10, 26));
        $cpf_cnpj = generateId();
        $telefone = generateId();
        $email = readable_random_string() . '@' . readable_random_string() . '.com';
        $senha = 'null';
        $id_aparelho = generateId();
        $conta_paga = 0;
        $anunciante_excluido = 0;

        $anunciante = array(

            'id_anunciante'         => $id_anunciante,
            'img_principal'         => 'null',
            'img_busca'             => 'null',
            'nome'                  => $nome, 
            'descricao'             => $descricao,
            'cpf_cnpj'              => $cpf_cnpj,
            'telefone'              => $telefone,
            'email'                 => $email,
            'senha'                 => $senha,
            'id_aparelho'           => $id_aparelho,
            'conta_paga'            => $conta_paga,
            'anunciante_excluido'   => $anunciante_excluido
        );

        $fb->dbInsert('tb_anunciantes', $anunciante);
    }

    $fb->success('OK');

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
