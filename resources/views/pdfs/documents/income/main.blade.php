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
@php
    $int = 1
@endphp
<h2>Поступление товаров № {{$item->id}} от {{ \Carbon\Carbon::parse($item->date)->format('d/m/Y')}}</h2>
<body>
<div style="    display: block;
    height: 4px;
    width: 100%;
    margin: 10px 0; background: black ">

</div>
<div style="height:40px; display: inline-block">
    <h4 style="float: left">Поставщик - {{$item->agent->name}}</h4>
    <h4 style="float: right">Склад - {{$item->storage->name}}</h4>
</div>
<div>
    <table>
        <tr>
            <th>№</th>
            <th colspan="2">Номенклатура</th>

            <th>Цена закупки</th>
            <th>Кол-во</th>
            <th>Сумма</th>
        </tr>
        @foreach($item->table_rows as $table_row)
            <tr>
                <td>{{$int++}}</td>
                <td>{{$table_row->nomenclature->name}} ({{$table_row->nomenclature->producer->name}})</td>
                <td>{{$table_row->characteristic->name}}</td>
                <td>{{sprintf('%02d', $table_row->price)}} руб.</td>
                <td>{{sprintf('%02d', $table_row->count)}} шт.</td>
                <td>{{sprintf('%02d', $table_row->count * $table_row->price)}} руб.</td>
            </tr>
        @endforeach
    </table>
</div>
<div style="    display: block;
    height: 4px;
    width: 100%;
    margin: 10px 0; background: black ">

</div>
<div style="display: inline-block">
    <p style="float:left">Подпись: ___________</p>
    <p style="float:right">Общая сумма - {{$item->doc_sum}} руб.</p>

</div>
</body>
</html>

