<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $data = $_POST['data'];

    $sql = 'INSERT INTO tb_usuario (nm_usuario, dt_nascimento) VALUES (:nome, :data)';
    
    try {
        $stmt = $PDO->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':data' => $data,
        ]);
        header('Location: index.php'); 
        exit;
    } catch (PDOException $e) {
        echo 'Erro ao registrar beneficiário:' . $e->getMessage();
    }
}
?>
