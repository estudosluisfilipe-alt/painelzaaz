<?php
// Administradores (senhas guardadas como hash bcrypt, nao em texto).
// Para trocar uma senha: php gerar_hash.php "nova senha" e cole o resultado abaixo.
$ADMINS = [
  'lipeehfontes' => '$2y$10$bxSgkaWbgf1OVWMjZeREwO2U5gSJGgXFl3YtdI4wPbIj2fZB8c8sK',
  'pedroh' => '$2y$10$.EKGgzSGa2R/fVw5ZZIU5ejzNl9j0SfkC.Yu86Jww1nL6Yq0Oj0GK',
];
date_default_timezone_set('America/Sao_Paulo');
