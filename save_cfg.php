<?php require __DIR__.'/config.php'; session_start(); header('Content-Type: application/json; charset=utf-8');
function fim($c,$m){http_response_code($c);echo json_encode(['ok'=>false,'erro'=>$m]);exit;}
if(empty($_SESSION['adm'])||!hash_equals((string)($_SESSION['csrf']??''),(string)($_SERVER['HTTP_X_CSRF']??'')))fim(403,'Sem permissão. Faça login novamente.');
$in=json_decode(file_get_contents('php://input'),true);$p=$in['p']??null;
if(!is_array($p)||count($p)!=3)fim(400,'Dados inválidos.');
$p=array_map(function($x){return max(0,min(30,(int)$x));},array_values($p));
$dir=__DIR__.'/data'; if(!is_dir($dir))mkdir($dir,0775,true);
$out=json_encode(['p'=>$p,'por'=>(string)($_SESSION['user']??''),'em'=>date('d/m/Y H:i')]);
$tmp=$dir.'/cfg.tmp';
if(file_put_contents($tmp,$out)===false||!rename($tmp,$dir.'/config.json'))fim(500,'Não foi possível gravar na pasta data (permissão).');
echo json_encode(['ok'=>true]);
