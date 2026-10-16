<?php if(PHP_SAPI!=='cli')exit('Execute pelo terminal.');echo password_hash($argv[1]??'',PASSWORD_DEFAULT),PHP_EOL;
