<?php

    //----------- remover isso para producao ------------------

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //---------------------------------------------------------

    date_default_timezone_set('America/Araguaina');

    require 'sistema/Config.php';
    require 'sistema/Database.php';

    $db = new DataBase();

    $codigos = array(

        '101' => 'demanda/obter-anuncios-iniciais.php',
        '102' => 'demanda/obter-anuncio-imagens.php'
    );

    if (!empty($_POST['plataforma']) &&     //Web, Android, iOS
        !empty($_POST['versao']) &&         //versao atual do front-end
        !empty($_POST['codigo'])) {         //demanda a ser solicitada

        $plataforma = $db->dbEscapeString($_POST['plataforma']);
        $versao = $db->dbEscapeString($_POST['versao']);
        $codigo = $db->dbEscapeString($_POST['codigo']);

        if (array_key_exists($codigo, $codigos)) {

            include $codigos[$codigo];

            //só será chamado se der erro no include.
            $db->dbRrror('Erro no include.');
        }
        else {

            $db->dbError('Código inválido.');
        }
    }
    else {

        $db->dbError('Acesso negado.');
    }

 ?>
