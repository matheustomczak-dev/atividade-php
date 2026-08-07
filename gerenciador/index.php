```php
<?php

function pacientesDiferentes($agenda) {
    $pacientes = array();

    foreach ($agenda as $consulta) {
        if (!in_array($consulta["paciente"], $pacientes)) {
            $pacientes[] = $consulta["paciente"];
        }
    }

    return count($pacientes);
}

function contarEspecialidades($agenda) {
    $especialidades = array();

    foreach ($agenda as $consulta) {
        $nome = $consulta["especialidade"];

        if (isset($especialidades[$nome])) {
            $especialidades[$nome]++;
        } else {
            $especialidades[$nome] = 1;
        }
    }

    return $especialidades;
}

function ordenarAgenda($agenda) {
    for ($i = 0; $i < count($agenda); $i++) {
        for ($j = $i + 1; $j < count($agenda); $j++) {
            if ($agenda[$i]["horario"] > $agenda[$j]["horario"]) {
                $temp = $agenda[$i];
                $agenda[$i] = $agenda[$j];
                $agenda[$j] = $temp;
            }
        }
    }

    return $agenda;
}

function pesquisarPaciente($agenda, $nome) {
    $resultado = array();

    foreach ($agenda as $consulta) {
        if ($consulta["paciente"] == $nome) {
            $resultado[] = $consulta;
        }
    }

    return $resultado;
}

function horariosDuplicados($agenda) {
    $horarios = array();

    foreach ($agenda as $consulta) {
        if (in_array($consulta["horario"], $horarios)) {
            return true;
        }

        $horarios[] = $consulta["horario"];
    }

    return false;
}

function organizarAgenda($agenda) {
    $agenda = ordenarAgenda($agenda);

    return array(
        "total" => count($agenda),
        "pacientes" => pacientesDiferentes($agenda),
        "especialidades" => contarEspecialidades($agenda),
        "primeiro" => $agenda[0],
        "ultimo" => $agenda[count($agenda) - 1],
        "agenda" => $agenda,
        "duplicados" => horariosDuplicados($agenda)
    );
}

$agenda = array(
    array("paciente" => "João", "especialidade" => "Cardiologia", "data" => "07/08/2026", "horario" => "08:00"),
    array("paciente" => "Maria", "especialidade" => "Dermatologia", "data" => "07/08/2026", "horario" => "09:00"),
    array("paciente" => "Pedro", "especialidade" => "Cardiologia", "data" => "07/08/2026", "horario" => "10:00")
);

$resultado = organizarAgenda($agenda);
$pesquisa = pesquisarPaciente($agenda, "João");

echo "Total: " . $resultado["total"] . "<br>";
echo "Pacientes diferentes: " . $resultado["pacientes"] . "<br>";
echo "Primeiro: " . $resultado["primeiro"]["horario"] . "<br>";
echo "Último: " . $resultado["ultimo"]["horario"] . "<br>";

?>
```
