<?php

    if (!empty($_POST['produto'])) {

        $produto = $fb->escapeString($_POST['produto']);

        /*if ($index < 1) $index= 1;

        $search_limit = 5; //5 anuncios por vez
        $limit = ($index - 1) * $search_limit;*/

        require 'sistema/metaphonePTBR.php';

        $metaphone = new Metaphone();

        $produto_soundex = $metaphone->getPhraseMetaphone($produto);
        $produto_soundex = getBooleanNames($produto_soundex);

        $result = $fb->dbRead("SELECT * FROM tb_anuncios WHERE anuncio_excluido = 0 AND MATCH (palavras_chave_soundex) AGAINST ('{$produto_soundex}' IN BOOLEAN MODE) ORDER BY data_cadastro");

        if (is_array($result)) {

            $resultados = count($result);

            $fb->success(base64_encode('Resultados encontrados: '.$resultados));
        }
        else {

            $fb->success(base64_encode('Resultado nao encontrado.'));
        }
    }
    else {

        $fb->success(base64_encode('Erro ao obter anúncios produtor.'));
    }

    function getBooleanNames($text) {

		$boolean_names = '';
		$nomes = explode(' ', $text);
		$count = count($nomes);

		for ($a = 0; $a < $count; $a++) {

			$soundex = $nomes[$a];
			$boolean_names .= "+{$soundex} ";
		}

		return trim($boolean_names);
	}

?>
