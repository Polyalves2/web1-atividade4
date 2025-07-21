<?php
// atividade 5 //

// Array inicial de alunos
$alunos = [
    [
        'nome' => 'João',
        'notas' => [2, 5, 7],
    ],
    [
        'nome' => 'Maria',
        'notas' => [1, 4, 6],
    ],
    [
        'nome' => 'Pedro',
        'notas' => [7, 8, 9],
    ],
    [
        'nome' => 'Ana',
        'notas' => [9, 7, 8],
    ]
];

// Função para calcular média
function calcularMedia($notas) {
    return array_sum($notas) / count($notas);
}

// Situação do aluno
function situacaoAluno($media) {
    if ($media >= 6) {
        return ['Aprovado', 'green'];
    } elseif ($media < 4) {
        return ['Reprovado', 'red'];
    } else {
        return ['Recuperação', 'orange'];
    }
}

// Se o formulário for enviado, adiciona novo aluno
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $notas = $_POST['notas'] ?? [];

    if (!empty($nome) && count($notas) >= 3) {
        $notasNumericas = array_map('floatval', $notas);
        array_push($alunos, [
            'nome' => $nome,
            'notas' => $notasNumericas
        ]);
    }
}

// Cálculo da média geral
$totalMedias = 0;
foreach ($alunos as $aluno) {
    $totalMedias += calcularMedia($aluno['notas']);
}
$mediaGeral = $totalMedias / count($alunos);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Alunos e Notas</title>
    <style>
        table {
            border-collapse: collapse;
            width: 70%;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }
        th {
            background: #f0f0f0;
        }
        .green { color: green; font-weight: bold; }
        .red { color: red; font-weight: bold; }
        .orange { color: orange; font-weight: bold; }
        .form-container {
            margin-bottom: 20px;
        }
        .notas-container input {
            margin-bottom: 5px;
        }
        .btn-add {
            background: #007bff;
            color: white;
            padding: 4px 10px;
            border: none;
            cursor: pointer;
            margin-left: 5px;
        }
        .btn-add:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Lista de Alunos</h2>
    <table>
        <tr>
            <th>Nome</th>
            <th>Notas</th>
            <th>Média</th>
            <th>Situação</th>
            <th>Ação</th>
        </tr>
        <?php foreach ($alunos as $index => $aluno): 
            $media = calcularMedia($aluno['notas']);
            [$situacao, $classe] = situacaoAluno($media);
        ?>
        <tr>
            <td><?= htmlspecialchars($aluno['nome']) ?></td>
            <td><?= implode(", ", $aluno['notas']) ?></td>
            <td><?= number_format($media, 2, ',', '.') ?></td>
            <td class="<?= $classe ?>"><?= $situacao ?></td>
            <td>
                <button onclick="mostrarAluno(<?= $index ?>)">Ver detalhes</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>Média geral da turma: <?= number_format($mediaGeral, 2, ',', '.') ?></h3>

    <div id="detalhesAluno" style="margin: 20px 0; font-weight:bold;"></div>

    <div class="form-container">
        <h3>Adicionar novo aluno</h3>
        <form method="POST">
            <label>Nome do aluno:</label><br>
            <input type="text" name="nome" required><br><br>

            <label>Notas:</label><br>
            <div class="notas-container">
                <input type="number" name="notas[]" step="0.1" required>
                <input type="number" name="notas[]" step="0.1" required>
                <input type="number" name="notas[]" step="0.1" required>
            </div>
            <button type="button" class="btn-add" onclick="adicionarNota()">+ Nota</button><br><br>

            <button type="submit">Adicionar Aluno</button>
        </form>
    </div>

    <script>
        const alunos = <?= json_encode($alunos) ?>;

        function mostrarAluno(index) {
            const aluno = alunos[index];
            const media = aluno.notas.reduce((a,b) => a+b, 0) / aluno.notas.length;
            let situacao = '';
            if (media >= 6) {
                situacao = '<span style="color:green;font-weight:bold;">Aprovado</span>';
            } else if (media < 4) {
                situacao = '<span style="color:red;font-weight:bold;">Reprovado</span>';
            } else {
                situacao = '<span style="color:orange;font-weight:bold;">Recuperação</span>';
            }
            document.getElementById('detalhesAluno').innerHTML = `
                <h3>Detalhes do Aluno</h3>
                Nome: ${aluno.nome}<br>
                Notas: ${aluno.notas.join(', ')}<br>
                Média: ${media.toFixed(2)}<br>
                Situação: ${situacao}
            `;
        }

        function adicionarNota() {
            const container = document.querySelector('.notas-container');
            const input = document.createElement('input');
            input.type = 'number';
            input.name = 'notas[]';
            input.step = '0.1';
            input.required = true;
            container.appendChild(document.createElement('br'));
            container.appendChild(input);
        }
    </script>
</body>
</html>