<?php 
use Skaisser\Monetizze;

include 'vendor/autoload.php';

$monetizze = new Monetizze('SUA_API_KEY_MONETIZZE');
// Buscar uma transacao por id!
$detalhesPedido = $monetizze->getSpecificTransaction(id_transacao);
