<?php
// atividade 4 //

// Definindo valores
$pipocas = [
    "grande" => 25.00,
    "medio" => 18.00,
    "pequeno" => 12.00
];

$filmes = [
    "Vingadores" => 30.00,
    "Avatar" => 28.00,
    "Super Mario" => 25.00
];

$valorPipoca = 0;
$valorFilme = 0;
$total = 0;
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tamanho = $_POST['pipoca'] ?? '';
    $filme = $_POST['filme'] ?? '';

    if (isset($pipocas[$tamanho]) && isset($filmes[$filme])) {
        $valorPipoca = $pipocas[$tamanho];
        $valorFilme = $filmes[$filme];
        $total = $valorPipoca + $valorFilme;

        $mensagem = "
            <h3>Resumo da Compra:</h3>
            Pipoca ($tamanho): R$ " . number_format($valorPipoca, 2, ',', '.') . "<br>
            Filme ($filme): R$ " . number_format($valorFilme, 2, ',', '.') . "<br>
            <strong>Total: R$ " . number_format($total, 2, ',', '.') . "</strong>
        ";
    } else {
        $mensagem = "<p style='color:red;'>Selecione uma pipoca e um filme.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Compra Cinema</title>
</head>
<body>
    <h2>Simulação de Compra - Cinema</h2>
    <form method="POST">
        <label for="pipoca">Escolha o tamanho da pipoca:</label><br>
        <select name="pipoca" id="pipoca" required>
            <option value="">-- Selecione --</option>
            <option value="grande">Balde Grande - R$ 25,00</option>
            <option value="medio">Balde Médio - R$ 18,00</option>
            <option value="pequeno">Balde Pequeno - R$ 12,00</option>
        </select>
        <br><br>

        <label for="filme">Escolha o filme:</label><br>
        <select name="filme" id="filme" required>
            <option value="">-- Selecione --</option>
            <option value="Vingadores">Vingadores - R$ 30,00</option>
            <option value="Avatar">Avatar - R$ 28,00</option>
            <option value="Super Mario">Super Mario - R$ 25,00</option>
        </select>
        <br><br>

        <button type="submit">Calcular Total</button>
    </form>

    <div style="margin-top:20px;">
        <?php echo $mensagem; ?>
    </div>
</body>
</html>

