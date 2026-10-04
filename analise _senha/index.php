<?php

function maiusculas($senha) {
    $qtd = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (ctype_upper($senha[$i])) {
            $qtd++;
        }
    }

    return $qtd;
}

function minusculas($senha) {
    $qtd = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (ctype_lower($senha[$i])) {
            $qtd++;
        }
    }

    return $qtd;
}

function numeros($senha) {
    $qtd = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (ctype_digit($senha[$i])) {
            $qtd++;
        }
    }

    return $qtd;
}

function especiais($senha) {
    $qtd = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (!ctype_alnum($senha[$i])) {
            $qtd++;
        }
    }

    return $qtd;
}

function analisarSenha($senha) {

    $pontos = 0;

    if (strlen($senha) >= 8) {
        $pontos++;
    }

    if (maiusculas($senha) > 0) {
        $pontos++;
    }

    if (minusculas($senha) > 0) {
        $pontos++;
    }

    if (numeros($senha) > 0) {
        $pontos++;
    }

    if (especiais($senha) > 0) {
        $pontos++;
    }

    if ($pontos <= 2) {
        $seguranca = "Fraca";
    } elseif ($pontos == 3) {
        $seguranca = "Média";
    } elseif ($pontos == 4) {
        $seguranca = "Forte";
    } else {
        $seguranca = "Muito Forte";
    }

    return array(
        "Maiúsculas" => maiusculas($senha),
        "Minúsculas" => minusculas($senha),
        "Números" => numeros($senha),
        "Especiais" => especiais($senha),
        "Tamanho" => strlen($senha),
        "Segurança" => $seguranca
    );
}

$senha = "Matheus@123";

$resultado = analisarSenha($senha);

echo "Maiúsculas: " . $resultado["Maiúsculas"] . "<br>";
echo "Minúsculas: " . $resultado["Minúsculas"] . "<br>";
echo "Números: " . $resultado["Números"] . "<br>";
echo "Especiais: " . $resultado["Especiais"] . "<br>";
echo "Tamanho: " . $resultado["Tamanho"] . "<br>";
echo "Segurança: " . $resultado["Segurança"];

?>

