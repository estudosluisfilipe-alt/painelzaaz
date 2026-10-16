<?php require __DIR__.'/config.php'; session_start(); header('Content-Type: application/json; charset=utf-8');
function fim($c,$m){http_response_code($c);echo json_encode(['ok'=>false,'erro'=>$m]);exit;}
if(empty($_SESSION['adm'])||!hash_equals((string)($_SESSION['csrf']??''),(string)($_SERVER['HTTP_X_CSRF']??'')))fim(403,'Sem permissão. Faça login novamente.');
$in=json_decode(file_get_contents('php://input'),true);
if(!is_array($in)||empty($in['rows'])||!is_array($in['rows']))fim(400,'Dados inválidos ou vazios.');
$dir=__DIR__.'/data'; if(!is_dir($dir))mkdir($dir,0775,true);
$out=json_encode(['em'=>date('d/m/Y H:i'),'por'=>(string)($_SESSION['user']??''),'rows'=>$in['rows']],JSON_UNESCAPED_UNICODE);
$atual=$dir.'/hierarquia.json';
if(is_file($atual))copy($atual,$dir.'/backup_hier_'.date('Ymd_His').'.json');
$tmp=$dir.'/hier.tmp';
if(file_put_contents($tmp,$out)===false||!rename($tmp,$atual))fim(500,'Não foi possível gravar na pasta data (permissão).');
echo json_encode(['ok'=>true,'total'=>count($in['rows'])]);
