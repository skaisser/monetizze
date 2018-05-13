<?php 
use Skaisser\Monetizze\ApiMonetizze;

include 'vendor/autoload.php';

$monetizze = new ApiMonetizze('SUA_API_KEY_MONETIZZE');
// Buscar uma transacao por id!
$detalhesPedido = $monetizze->getSpecificTransaction(id_transacao);
