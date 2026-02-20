INSERT INTO administradores (nome, email, password_hash, perfil)
VALUES ('Administrador Geral', 'admin@anapro.org', '$2y$12$m7eHLYFqqguzvOmSo/T3RO7OgEpoyRSEOm4rtAltscJ2Mv6mbJzgi', 'super_admin')
ON DUPLICATE KEY UPDATE nome = VALUES(nome);
