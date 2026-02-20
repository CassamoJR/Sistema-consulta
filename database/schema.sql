CREATE TABLE IF NOT EXISTS membros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_completo VARCHAR(150) NOT NULL,
    genero VARCHAR(30) NOT NULL,
    data_nascimento DATE NOT NULL,
    nivel_academico VARCHAR(100) NOT NULL,
    area_formacao VARCHAR(120) NOT NULL,
    ano_ingresso YEAR NOT NULL,
    provincia VARCHAR(100) NOT NULL,
    distrito VARCHAR(100) NOT NULL,
    zip VARCHAR(20) NOT NULL,
    escola VARCHAR(150) NOT NULL,
    contacto VARCHAR(30) NOT NULL,
    estado ENUM('Pendente','Aprovado','Rejeitado') NOT NULL DEFAULT 'Pendente',
    data_registo DATETIME NOT NULL
);

CREATE TABLE IF NOT EXISTS administradores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    perfil ENUM('super_admin','financeiro','operador') NOT NULL DEFAULT 'operador'
);

CREATE TABLE IF NOT EXISTS contribuicoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    membro_id INT NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    mes_referencia TINYINT NOT NULL,
    ano_referencia YEAR NOT NULL,
    estado_pagamento ENUM('Pago','Pendente','Atrasado') NOT NULL DEFAULT 'Pendente',
    data_pagamento DATETIME NULL,
    CONSTRAINT fk_contrib_membro FOREIGN KEY (membro_id) REFERENCES membros(id)
);

CREATE TABLE IF NOT EXISTS auditoria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    accao VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    data_evento DATETIME NOT NULL,
    CONSTRAINT fk_auditoria_admin FOREIGN KEY (admin_id) REFERENCES administradores(id)
);
