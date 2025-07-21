<?php
// atividade 2 //

// $frase = "informar a string e a quantidade de vogais.";
$frase = "Testando.";
$quantidade = preg_match_all('/[aeiou]/i', $frase);

echo "Frase: $frase<br>";
echo "Número de vogais: $quantidade<br><br>";
?>
