@section ('Title')
Kasir
@endsection
@extends('kasir.template_kasir')
@section('dashboard')
<!doctype html>
<html lang="en">
<head>
</head>
<body class="h-screen bg-gray-100">

<div class="container px-4 mx-auto">

    <div class="p-6 m-20 bg-white rounded shadow">
        {!! $chart->container() !!}
    </div>

</div>

<script src="{{ $chart->cdn() }}"></script>

{{ $chart->script() }}
</body>
</html>
@endsection