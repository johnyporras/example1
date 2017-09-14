@extends('layouts.app')

@section('content')
    
        <h3 class="pull-left">Eventos</h3>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('eventos.create') !!}">Incluir Nuevo</a>
        </h1>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('eventos.table')
            </div>
        </div>
    </div>
@endsection

