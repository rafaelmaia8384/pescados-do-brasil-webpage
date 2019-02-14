<?php

    require '../app-v1.0/sistema/config.php';
    require '../app-v1.0/sistema/database.php';
    require '../app-v1.0/sistema/feedback.php';

    $fb = new FeedBack();

    if (!empty($_POST['id_usuario'])            &&
        !empty($_POST['nome_anunciante'])       &&
        !empty($_POST['tipo_pescado'])          &&
        !empty($_POST['tipo_agua'])             &&
        !empty($_POST['fresco_congelado'])      &&
        !empty($_POST['possui_selo_inspecao'])  &&
        !empty($_POST['total_disponivel'])      &&
        !empty($_POST['faz_entrega'])      	    &&
        !empty($_POST['uf_produto'])            &&
        !empty($_POST['municipio_produto'])     &&
        !empty($_POST['titulo'])                &&
        !empty($_POST['descricao'])             &&
        !empty($_POST['telefone'])) {

        $id_usuario = $fb->escapeString($_POST['id_usuario']);
        $nome_anunciante = $fb->escapeString($_POST['nome_anunciante']);
        $tipo_pescado = $fb->escapeString($_POST['tipo_pescado']);
        $tipo_agua = $fb->escapeString($_POST['tipo_agua']);
        $fresco_congelado = $fb->escapeString($_POST['fresco_congelado']);
        $possui_selo_inspecao = $fb->escapeString($_POST['possui_selo_inspecao']);
        $total_disponivel = $fb->escapeString($_POST['total_disponivel']);
        $faz_entrega = $fb->escapeString($_POST['faz_entrega']);
        $uf_produto = $fb->escapeString($_POST['uf_produto']);
        $municipio_produto = $fb->escapeString($_POST['municipio_produto']);
        $titulo = $fb->escapeString($_POST['titulo']);
        $descricao = $fb->escapeString($_POST['descricao']);
        $telefone = $fb->escapeString($_POST['telefone']);

        do {

            $codigo_anuncio = mt_rand(10000000, 99999999);

            $result = $fb->dbRead("SELECT id_anuncio FROM tb_anuncio WHERE codigo_anuncio = {$codigo_anuncio} AND anuncio_excluido = 0 LIMIT 1");

        } while (is_array($result));

        $result = $fb->dbRead("SELECT conta_paga FROM tb_usuario WHERE id_usuario = {$id_usuario} LIMIT 1");

        $anuncio_pago = $result[0]['conta_paga'];

        $data = array(

            'id_usuario'            => $id_usuario,
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
            'titulo'                => $titulo,
            'descricao'             => $descricao,
            'telefone'              => $telefone,
            'anuncio_pago'          => $anuncio_pago
        );

        $fb->dbInsert('tb_anuncio', $data);

        $result = $fb->dbRead("SELECT id_anuncio FROM tb_anuncio WHERE codigo_anuncio = {$codigo_anuncio} LIMIT 1");

        $fb->success('Anúncio cadastrado.', $result);
    }
    else {

        $fb->error('Erro no preenchimento dos dados: cadastrar-anuncio.php');
    }

?>
