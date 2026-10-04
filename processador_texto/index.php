<?php

function separarPalavras($texto) {
    $texto = trim($texto);
    $texto = preg_replace('/\s+/', ' ', $texto);

    return explode(" ", $texto);
}

function contarCaracteres($texto) {
    return strlen($texto);
}

function contarPalavras($texto) {
    $palavras = separarPalavras($texto);

    return count($palavras);
}

function contarFrases($texto) {
    $frases = preg_split('/[.!?]+/', $texto);

    return count(array_filter($frases));
}

function maiorMenorPalavra($texto) {
    $palavras = separarPalavras($texto);

    $maior = $palavras[0];
    $menor = $palavras[0];

    foreach ($palavras as $palavra) {
        if (strlen($palavra) > strlen($maior)) {
            $maior = $palavra;
        }

        if (strlen($palavra) < strlen($menor)) {
            $menor = $palavra;
        }
    }

    return array($maior, $menor);
}

function processarTexto($texto) {

    $texto = trim($texto);
    $texto = preg_replace('/\s+/', ' ', $texto);

    $palavras = separarPalavras($texto);
    $contagem = array_count_values($palavras);

    $maiorMenor = maiorMenorPalavra($texto);

    $repetidas = 0;

    foreach ($contagem as $quantidade) {
        if ($quantidade > 1) {
            $repetidas++;
        }
    }

    arsort($contagem);

    return array(
        "caracteres" => contarCaracteres($texto),
        "palavras" => contarPalavras($texto),
        "frases" => contarFrases($texto),
        "maior" => $maiorMenor[0],
        "menor" => $maiorMenor[1],
        "repetidas" => $repetidas,
        "frequentes" => array_slice($contagem, 0, 5, true),
        "semEspacos" => $texto,
        "formatado" => ucwords(strtolower($texto))
    );
}

$texto = "o computador é muito rápido. o computador funciona muito bem.";

$resultado = processarTexto($texto);

echo "Caracteres: " . $resultado["caracteres"] . "<br>";
echo "Palavras: " . $resultado["palavras"] . "<br>";
echo "Frases: " . $resultado["frases"] . "<br>";
echo "Palavra maior: " . $resultado["maior"] . "<br>";
echo "Palavra menor: " . $resultado["menor"] . "<br>";
echo "Palavras repetidas: " . $resultado["repetidas"] . "<br>";
echo "Texto sem espaços duplicados: " . $resultado["semEspacos"] . "<br>";
echo "Texto formatado: " . $resultado["formatado"] . "<br>";

?>