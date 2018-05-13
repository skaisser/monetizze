Monetizze Api 2.1 PHP-SDK (EM DESENVOLVIMENTO)
=================

SDK não-oficial de integração á API da Monetizze

Instalação
----------

A biblioteca pode ser instalada usando o gerenciador de dependência composer. Para instalar a biblioteca e todas suas dependências execute:

```bash
composer require skaisser/monetizze
```


Exemplo
-------

```php
<?php
include 'vendor/autoload.php';

use Skaisser\Monetizze\Monetizze;


$monetizze = new Monetizze('SUA_API_KEY_MONETIZZE');

```

Transacoes
--------

```php
// Pegar detalhes de uma transação especifica
$detalhesTransacao = $monetizze->getSpecificTransaction(12312312);


```


Transaçoes por Clientes
--------

```php
// Buscar Transacoes por E-mail
$transacoes = $monetizze->getTransactionsByCustomerEmail("email@cliente.com");

```


Boletos
------------

```php
// Altera o Vencimento de Um Boleto pela transação
$boleto = $monetizze->changeBoletoDueDate(123456, '2018-06-01');

```


Codigos de Rastreios Correios
------------

```php
// Enviar Codigo de Rastreio de Um Pedido Enviado Pelos Correios
// Recebe o Id da Transacao e o Codigo de Rastreio
$monetizze->addCorreiosTrackingNumber(123456, 'PA123456789BR');

```




Documentação Oficial
--------------------

Obs.: Esta é uma API não oficial. Foi feita com base na documentação disponibilizada [neste link](https://api.monetizze.com.br/2.1/apidoc/#api-Produtor-Tracking).


Creditos
--------

* [Kapsula](http://www.kapsula.com.br)

Suporte
-------

[Para reportar um novo bug por favor abra um novo Issue no github](https://github.com/skaisser/monetize/issues)


Licença
-------

Distribuido sobre a licença MIT. Copie, cole, modifique, melhore e compartilhe!