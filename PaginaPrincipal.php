<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./src/imagens/Cadastro.png" type="image/x-icon"> 
    <link rel="stylesheet" href="./src/css/botao.css">
    <link rel="stylesheet" href="./src/css/estilos.css">
    <link rel="stylesheet" href="./src/css/modal.css">
    <link rel="stylesheet" href="./src/css/records.css">
    
    <title>Cadastro de clientes</title>
   
</head>

<body>

<script> 
'use strict'

const openCompraModal = () => document.getElementById('modalCompra')
    .classList.add('active')

const openBeneficiarioModal = () => document.getElementById('modalBeneficiario')
    .classList.add('active')

const closeModal = () => {
    clearFields()
    document.querySelectorAll('.modal').forEach(modal => modal.classList.remove('active'));
    document.querySelectorAll('.modalBeneficiario').forEach(modal => modal.classList.remove('active'));
}

const clearFields = () => {
    const fields = document.querySelectorAll('.modal-field')
    fields.forEach(field => field.value = "")
    document.getElementById('nome').dataset.index = 'new'
    document.querySelector(".modal-header>h2").textContent  = 'Nova Compra'
}

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('cadastrarCompra')
        .addEventListener('click', openCompraModal)

document.getElementById('cadastrarBeneficiario')
        .addEventListener('click', openBeneficiarioModal)

    document.getElementById('modalClose')
        .addEventListener('click', closeModal)

    document.getElementById('cancelar')
        .addEventListener('click', closeModal)
})
</script>
    
    <header>
        <h1 class="header-title">Cadastro de Compras</h1>
    </header>

    <main>
    <div class="button-container">
        <button type="button" class="button blue mobile" id="cadastrarCompra">Registro das Compras</button>
        <button type="button" class="button blue mobile" id="cadastrarBeneficiario">Registro dos Beneficiários</button>
        <a href="index.php"> <button type="button" class="button blue mobile" id="Sair">Sair</button> </a>
    </div>
        <table id="tableClient" class="records">
            <thead>
                <tr>
                    <th>Descrição da compra</th>
                    <th>Valor</th>
                    <th>Forma de Pagamento</th>
                    <th>Beneficiário</th>
                    <th>Estado da Fatura</th> 
                    <th>Atualização</th> 

                </tr>
            </thead>
            <tbody>
              
            
                <?php
                include('conexao.php');
                $sql = 'SELECT ds_produto, vl_produto, id_pagamento, nm_beneficiario, id_fatura FROM tb_compra';
                foreach ($PDO->query($sql) as $row) {
                    echo '<tr>';
                    echo '<td>'. htmlspecialchars($row['ds_produto']) .'</td>';
                    echo '<td>'. htmlspecialchars($row['vl_produto']) .'</td>';
                    echo '<td>'. htmlspecialchars($row['id_pagamento']) .'</td>';
                    echo '<td>'. htmlspecialchars($row['nm_beneficiario']) .'</td>';
                    echo '<td>'. htmlspecialchars($row['id_fatura']) .'</td>';
                
                    echo '<td>
                    <button type="button" class="button yellow">Alterar</button>
                    <button type="button" class="button red">Excluir</button>
                  </td>';
            echo '</tr>';
                }
                ?>
            </tbody>
        </table>

        <div class="modal" id="modalCompra">
            <div class="modal-content">
                <header class="modal-header">
                    <h2>Registro da Compra</h2>
                    <span class="modal-close" id="modalClose">&#10006;</span>
                </header>
                <form id="form" class="modal-form" method="post" action="insercao.php">
                    <input type="text" id="nome" name="nome" class="modal-field" placeholder="Descrição da compra" required>
                    <input type="number" id="valor" name="valor" class="modal-field" placeholder="Valor" required>
                    <select id="formaPagamento" name="formaPagamento" class="modal-field" required>
                        <option value="" selected disabled hidden>Forma de Pagamento</option>
                        <option value="cartao">Cartão</option>
                        <option value="boleto">Boleto</option>
                        <option value="dinheiro">Dinheiro</option>
                        <option value="transferencia">Transferência</option>
                    </select>
                    <select id="beneficiario" name="beneficiario" class="modal-field" required>
                         <option value="" selected disabled hidden>Selecione o beneficiário</option>
                          <?php
                               $sql_beneficiarios = 'SELECT nm_usuario FROM tb_usuario';
                               foreach ($PDO->query($sql_beneficiarios) as $row) {
                               echo '<option value="'. htmlspecialchars($row['nm_usuario']) .'">'. htmlspecialchars($row['nm_usuario']) .'</option>';
                                  }
                                   ?>
                    </select>
                    <select class="modal-field" id="estadoPagamento" name="estadoPagamento" required>
                        <option value="" selected disabled hidden>Estado da Fatura</option>
                        <option value="liquidado">Liquidado</option>
                        <option value="em_aberto">Em aberto</option>
                        <option value="em_atraso">Em atraso</option>
                    </select>
                    <footer class="modal-footer">
                        <img width="50px" height="50px" class="imagem-cadastro" src="./src/imagens/Cadastro.png" alt="Imagem de cadastro.">
                        <button type="submit" id="salvar" class="button green">Gravar</button>
                        <button type="button" id="cancelar" class="button blue">Cancelar</button>
                    </footer>
                </form>
            </div>
        </div>

        <div class="modal" id="modalBeneficiario">
            <div class="modal-content">
            <header class="modal-header">
            <h2>Registro do beneficiário</h2>
                </header>
                <form id="form" class="modal-form" method="post" action="insercaoBeneficiario.php">
                    <input type="text" id="nome" name="nome" class="modal-field" placeholder="Nome do beneficiário" required>
                    <input type="date" id="data" name="data" class="modal-field" placeholder="Data de nascimento" required>
                    <footer class="modal-footer">
                        <img width="50px" height="50px" class="imagem-cadastro" src="./src/imagens/Cadastro.png" alt="Imagem de cadastro.">
                        <button type="submit" id="salvar" class="button green">Gravar</button>
                        <button type="button" id="cancelar" class="button blue" onclick="closeModal()">Cancelar</button>    
                    </footer>
                </form>
            </div>
            </div>
    </main>

</body>
</html>
