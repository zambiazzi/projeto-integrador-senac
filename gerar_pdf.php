<?php
require('library/tcpdf.php');
include 'conexao.php';

$pdf = new TCPDF();

$pdf->AddPage();

$content = '<h1>Relatório de Usuários</h1>';

$sql = "SELECT id, nome FROM usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $content .= '<table border="1">';
    $content .= '<tr><th>ID</th><th>Usuário</th></tr>';
    while ($row = $result->fetch_assoc()) {
        $content .= '<tr>';
        $content .= '<td>'.$row['id'].'</td>';
        $content .= '<td>'.$row['nome'].'</td>';
        $content .= '</tr>';
    }
    $content .= '</table>';
} else {
    $content .= '<p>Nenhum usuário encontrado.</p>';
}

$pdf->writeHTML($content, true, false, true, false, '');

$pdf->Output('relatorio_usuarios.pdf', 'I');

$conn->close();
?>
