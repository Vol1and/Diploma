@extends('layouts.app')

@section('content')
<div>
    <notifications position="bottom right" group="my" ></notifications>
    <router-view></router-view>
</div>
@endsection
