<?php

    //----------- remover isso para producao ------------------

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //---------------------------------------------------------

    date_default_timezone_set('America/Araguaina');

    require 'sistema/config.php';
    require 'sistema/database.php';
    require 'sistema/feedback.php';

    $fb = new FeedBack();

    $codigos = array(

        '101' => 'demanda/obter-anuncios-produtor.php',
        '102' => 'demanda/buscar-produto.php'
    );

    if (!empty($_POST['plataforma']) &&     //Web, Android, iOS
        !empty($_POST['versao']) &&         //versao atual do front-end
        !empty($_POST['codigo'])) {         //demanda a ser solicitada

        $plataforma = $fb->escapeString($_POST['plataforma']);
        $versao = $fb->escapeString($_POST['versao']);
        $codigo = $fb->escapeString($_POST['codigo']);

        if (array_key_exists($codigo, $codigos)) {

            if ($fb->checkVersion($plataforma, $versao)) {

                include $codigos[$codigo];

                //só será chamado se der erro no include.
                $fb->error('Erro no include.');
            }
            else {

                $extra = array('atualizar' => '1');

                $fb->error('Versão desatualizada.', $extra);
            }
        }
        else {

            $fb->error('Código inválido.');
        }
    }
    else {

        $fb->error('Erro no preenchimento dos campos: app.php');
    }

 ?>
