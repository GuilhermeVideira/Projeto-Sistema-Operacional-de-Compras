create database bd_compra;
use bd_compra;
 
create table tb_compra(
cd_compra int auto_increment primary key, 
ds_produto varchar(100) not null, 
vl_produto int not null,
id_pagamento varchar(45), 
nm_beneficiario varchar(45), 
id_fatura varchar(50)
);
 
create table tb_usuario ( 
cd_usuario int auto_increment primary key, 
nm_usuario varchar(45), 
dt_nascimento date
);

INSERT INTO tb_compra VALUES (NULL, 'LARANJA', '23', '1', 'Guilherme', '2');
select * from tb_compra;
 