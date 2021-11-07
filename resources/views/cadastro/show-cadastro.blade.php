@extends('main')

@section('content')
    <div class="container mt-5">
        {{--Comentado por causa da adição dos swal --}}
        {{--@if(session('status'))
            <div class="row d-flex justify-content-center">
                 <div class="col-md-6 mt-3">
                    <div class="alert alert-success text-center">
                        {{session('status')}}
                    </div>
                 </div>
            </div>
        @endif--}}
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 mt-3">
                <div class="card text-center ml-3 mb-5">
                    <div class="card-header text-uppercase">
                        {{$cadastro->name}}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$cadastro->email}}</h5>
                        <p class="card-text">{{$cadastro->message}}</p>
                        <a href="{{url('download/'.$cadastro->id)}}" class="btn btn-info btn-sm">Arquivo</a>
                    </div>
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <small class="text-muted text-left ml-2">{{$cadastro->created_at->diffForHumans()}}</small>
                        </div>
                        <div class="col-md-6 ">
                            <small class="text-muted text-right d-flex justify-content-end mr-2">Visualizações: {{$cadastro->total_visualizacao}}</small>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{url('adicionar-gostei/'.$cadastro->id)}}" onclick="gostei()" class="btn btn-success btn-sm mr-3">Gostei ({{$cadastro->total_gostei}})</a>
                        <a href="{{url('adicionar-naogostei/'.$cadastro->id)}}" onclick="naoGostei()" class="btn btn-danger btn-sm">Não Gostei ({{$cadastro->total_naogostei}})</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/cadastro.js') }}"></script>
@endsection
