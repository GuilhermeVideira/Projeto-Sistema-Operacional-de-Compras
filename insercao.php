<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $valor = $_POST['valor'];
    $formaPagamento = $_POST['formaPagamento'];
    $beneficiario = $_POST['beneficiario'];
    $estadoPagamento = $_POST['estadoPagamento'];

    $sql = 'INSERT INTO tb_compra (ds_produto, vl_produto, id_pagamento, nm_beneficiario, id_fatura) VALUES (:nome, :valor, :formaPagamento, :beneficiario, :estadoPagamento)';
    
    try {
        $stmt = $PDO->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':valor' => $valor,
            ':formaPagamento' => $formaPagamento,
            ':beneficiario' => $beneficiario,
            ':estadoPagamento' => $estadoPagamento,
        ]);
        header('Location: index.php'); 
        exit;
    } catch (PDOException $e) {
        echo 'Erro ao registrar compra: ' . $e->getMessage();
    }
}
?>
