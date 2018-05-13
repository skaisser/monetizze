<?php 
use Skaisser\Monetizze\Monetizze;

include 'vendor/autoload.php';

$monetizze = new Monetizze('');
$detalhesPedido = $monetizze->getSpecificTransaction(6170708);
var_dump($detalhesPedido);
