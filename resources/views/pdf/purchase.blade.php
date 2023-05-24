<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body>
  <h1>Relatório da compra</h1>
  <h2>Informações do usuário</h2>
  <p>Nome: {{ $purchase->user->name }}</p>
  <p>Email: {{ $purchase->user->email }}</p>
  <h2>Informações do cliente</h2>
  <p>Nome: {{ $purchase->client->name }}</p>
  <h2>Lista de produtos</h2>
  @foreach ($purchase->products as $product)
    {{ $product->name }} - {{ $product->formated_price }}
  @endforeach
  <p>Valor total da compra: R$ {{ number_format($purchase->price, 2, ',', '.') }}</p>
  <b>Compra criada em: {{ $purchase->created_at }}</b>
  <h2>Lista de parcelas</h2>
  @foreach ($purchase->installments as $installment)
    <p>Valor: {{ $installment->price }}</p>
    <p>Data de vencimento: {{ date('d/m/Y', strtotime($installment->expiration_date)) }}</p>
    <p>Observação: {{ $installment->observation }}</p>
    <hr>
  @endforeach
</body>

</html>
