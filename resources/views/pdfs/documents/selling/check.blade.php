<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="/public/css/app.css" rel="stylesheet" type="text/css">

</head>
<style>
    @font-face {
        font-family: "My Custom Font";
        src: url(/public/fonts/dotf1.ttf) format("truetype");
    }
   body {
        font-family: "My Custom Font",DejaVu Sans, sans-serif;
    }

    table {
        font-family: "My Custom Font", DejaVu Sans, sans-serif;
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

<body>
<div style="width: 30%;">
    <p>===============</p>
    <p style="font-size: 15px;">PHARMACY ENTERPISE P-S</p>
    <p style="font-size: 10px;text-align: center" >ЧЕК № {{$item->id}}</p>
{{--    <p>КАССИР: </p>--}}
    <p> ДОБРО ПОЖАЛОВАТЬ</p>
    @foreach($item->table_rows as $table_row)

        <p style="font-size: 10px">{{$table_row->nomenclature->name}} </p>
        <p style="font-size: 10px">{{str_pad($table_row->price,2,'0',STR_PAD_LEFT)}} X {{str_pad($table_row->count,2,'0',STR_PAD_LEFT)}}
            = {{str_pad(($table_row->count *  $table_row->price),2,'0',STR_PAD_LEFT)}}</p>
    @endforeach
    <p style="font-size: 12px" >  -------  ВСЕГО ПО ЧЕКУ  -----</p>
    <p>ИТОГ: {{$item->doc_sum}} РУБ</p>
    <p style="font-size: 12px;">--- СПАСИБО ЗА ПОКУПКУ ---</p>
    <p>===============</p>
</div>
</body>
</html>

