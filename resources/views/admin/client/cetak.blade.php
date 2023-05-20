<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/print.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('assets/css/print.css') }}" media="print">
    <title>{{ $title }}</title>
</head>
<body>
    <div class="cetak">
        <h1 class="text-center">{{ $produk->nama_produk }}</h1>
    </div>
</body>
</html>