<?php
// atividade 1 //

$nota1 = 1.5;
$nota2 = 5.0;
$nota3 = 5.5;
$nota4 = 2.0;

$media = ($nota1 + $nota2 + $nota3 + $nota4) / 4;

if ($media >= 6) {
    $resultado = "Aprovado";
} elseif ($media < 4) {
    $resultado = "Reprovado";
} else {
    $resultado = "Em recuperação";
}

echo "<h2>Resultado total do aluno</h2>";
echo "Notas: $nota1, $nota2, $nota3, $nota4<br>";
echo "Média: " . number_format($media, 2) . "<br>";
echo "Resultado: <strong>$resultado</strong><br><br>";

?>
