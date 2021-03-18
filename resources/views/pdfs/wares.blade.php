<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="/public/css/app.css" rel="stylesheet" type="text/css">

</head>
<style>
    body {
        font-family: DejaVu Sans, sans-serif;
    }

    table {
        font-family: DejaVu Sans, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        font-size: 16px;
    }

    td {
        padding: 4px;
        font-size: 13px;
    }

</style>
<body>
{{--<h1>Зря</h1>--}}
<h2>Остатки товаров на {{\Carbon\Carbon::now()->format('d/m/Y')}}</h2>
@if($storage)
    <h4>Склад: {{$storage->name}}</h4>
@endif
@if($nomenclature)
    <h4>Номенклатура: {{$nomenclature->name}}</h4>
@endif
<div style="    display: block;
    height: 4px;
    width: 100%;
    margin: 10px 0; background: black ">

</div>


<div>


    <table>
        <tr>
            <th>Склад</th>
            <th>Номенклатура</th>
            <th>Характеристика</th>
            <th>Остатки</th>
        </tr>
        @foreach($items as $item)
            <tr>
                <td>{{$item->storage->name}}</td>
                <td>{{$item->characteristic->nomenclature->name}}</td>
                <td>{{$item->characteristic->name}}</td>
                <td>{{$item->ware}}</td>
            </tr>
        @endforeach
    </table>
</div>
</body>
</html>
