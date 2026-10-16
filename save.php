<?php require __DIR__.'/config.php'; session_start(); header('Content-Type: application/json; charset=utf-8');
function fim($c,$m){http_response_code($c);echo json_encode(['ok'=>false,'erro'=>$m]);exit;}
if(empty($_SESSION['adm'])||!hash_equals((string)($_SESSION['csrf']??''),(string)($_SERVER['HTTP_X_CSRF']??'')))fim(403,'Sem permissão. Faça login novamente.');
$in=json_decode(file_get_contents('php://input'),true);
if(!is_array($in)||empty($in['rows'])||!is_array($in['rows']))fim(400,'Dados inválidos ou vazios.');
$dir=__DIR__.'/data'; if(!is_dir($dir))mkdir($dir,0775,true);
$em=date('d/m/Y H:i');
$out=json_encode(['nome'=>mb_substr((string)($in['nome']??''),0,120),'em'=>$em,'por'=>(string)($_SESSION['user']??''),'rows'=>$in['rows']],JSON_UNESCAPED_UNICODE);
if($out===false)fim(500,'Falha ao gerar a base.');
$atual=$dir.'/base.json';
if(is_file($atual)){copy($atual,$dir.'/backup_'.date('Ymd_His').'.json');$b=glob($dir.'/backup_*.json');sort($b);foreach(array_slice($b,0,max(0,count($b)-5)) as $x)@unlink($x);}
$tmp=$dir.'/base.tmp';
if(file_put_contents($tmp,$out)===false||!rename($tmp,$atual))fim(500,'Não foi possível gravar na pasta data (permissão).');
echo json_encode(['ok'=>true,'em'=>$em,'total'=>count($in['rows'])]);
