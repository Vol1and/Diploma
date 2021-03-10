@extends('layouts.app')

@section('content')
<div>
<el-row>

<side-bar></side-bar>
    <el-col :span="23" :offset="1"> <router-view style="margin-top: 30px"></router-view></el-col>
</el-row>


</div>
@endsection
