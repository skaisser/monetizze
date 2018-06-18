Monetizze Api 2.1 PHP-SDK
=================

SDK não-oficial de integração á API da Monetizze

Instalação
----------

A biblioteca pode ser instalada usando o gerenciador de dependência composer. Para instalar a biblioteca e todas suas dependências execute:

```bash
composer require skaisser/monetizze
```


Iniciando o SDK
-------

```php
<?php
include 'vendor/autoload.php';

use Skaisser\Monetizze\ApiMonetizze;


$monetizze = new ApiMonetizze('SUA_API_KEY_MONETIZZE');

```

Transações
--------

```php
// Pegar detalhes de uma transação especifica pelo id da transação
$detalhesTransacao = $monetizze->getTransactionDetails(12312312);

```


Transações por Clientes
--------

```php
// Buscar Transacoes por E-mail
$transacoes = $monetizze->getTransactionsByEmail("email@cliente.com");

```


Transações por Filtro Avançado
--------

```php
// Buscar Transacoes por um filtro avançado
$filters = [
    'product'  => '123455',
    'date_min' => '2018-01-01 00:00:00',
    'date_max' => '2018-04-01 23:59:59',
    'status'   => ['2','3','4','5','6'] // 2 - Finalizada 3 - Cancelada 4 - Devolvida 5 - Bloqueada 6 - Completa
];
$transacoes = $monetizze->getTransactionsByAdvancedFilter($filters);

```

Para checar todas as opções de filtro visite a [documentação oficial](http://api.monetizze.com.br/2.1/apidoc/#api-Geral-Transactions).

Boletos
------------

```php
// Altera o Vencimento de Um Boleto de uma transação Especifica
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

Obs.: Esta é uma API não oficial. Foi feita com base na documentação disponibilizada [neste link](https://api.monetizze.com.br/2.1/apidoc).


Creditos
--------

* [Kapsula](http://www.kapsula.com.br)
* [Grupo KPG](http://www.grupokpg.com)

Suporte
-------

[Para reportar um novo bug por favor abra um novo Issue no github](https://github.com/skaisser/monetizze/issues)


Licença
-------

Distribuido sobre a licença MIT. Copie, cole, modifique, melhore e compartilhe!