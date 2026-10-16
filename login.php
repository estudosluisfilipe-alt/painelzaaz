<?php require __DIR__.'/config.php'; session_start();
if(isset($_GET['sair'])){session_destroy();header('Location: index.php');exit;}
$erro='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $u=strtolower(trim((string)($_POST['u']??'')));
  if(isset($ADMINS[$u])&&password_verify((string)($_POST['p']??''),$ADMINS[$u])){
    session_regenerate_id(true);$_SESSION['adm']=1;$_SESSION['user']=$u;$_SESSION['csrf']=bin2hex(random_bytes(16));header('Location: index.php');exit;}
  sleep(2);$erro='Usuário ou senha inválidos.';}
?><!doctype html><html lang="pt-BR"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Acesso administrador</title>
<style>body{font:15px system-ui,"Segoe UI",sans-serif;background:linear-gradient(135deg,#0b1f4d,#1e40af);display:grid;place-items:center;min-height:100vh;margin:0;color:#0f172a}form{background:#fff;border-radius:16px;padding:28px;width:320px;display:grid;gap:12px;box-shadow:0 20px 50px rgba(0,0,0,.35)}input,button{font:inherit;padding:10px;border-radius:9px;border:1px solid #cbd5e1;background:#fff;color:inherit}button{background:#1e40af;border-color:#1e40af;color:#fff;cursor:pointer;font-weight:600}a{color:#1e40af;font-size:13px}.e{color:#b91c1c;font-size:13px}h3{margin:0;font-size:19px}</style></head><body>
<form method="post"><h3>Painel de Operações<br><small style="font-weight:400;color:#64748b;font-size:13px">Acesso administrador</small></h3>
<input name="u" placeholder="Usuário" autocomplete="username" required autofocus><input name="p" type="password" placeholder="Senha" autocomplete="current-password" required>
<?php if($erro) echo '<div class="e">'.htmlspecialchars($erro).'</div>'; ?><button>Entrar</button><a href="index.php">← Voltar ao painel</a></form></body></html>
