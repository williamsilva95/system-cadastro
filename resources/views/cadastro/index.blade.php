@extends('main')

@section('content')
    <div class="container mt-4">
        <br/>
        <div class="card">
            <div class="card-header text-right">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <a href="{{url('criar-cadastro')}}" class="btn btn-primary btn-sm" role="button">Novo Cadastro</a>
                        <a href="{{url('exportar')}}" class="btn btn-success btn-sm" role="button">Exportar</a>
                    </div>
                    <div class="col-md-6">
                        <form class="form-inline my-lg-0 d-flex justify-content-end" action="{{url('pesquisar')}}" method="post">
                            {{csrf_field()}}
                            <input class="form-control mr-sm-2 form-control-sm" type="search" placeholder="Search" aria-label="Search" name="texto">
                            <button class="btn btn-success btn-sm" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($cadastro as $value)
                            <div class="col-md-4 mb-3">
                            <div class="card text-center ml-2 mb-5 h-100">
                                <div class="card-header text-uppercase">
                                    {{$value->name}}
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{$value->email}}</h5>
                                    <p class="card-text">{{$value->message}}</p>
                                    <a href="{{url('download/'.$value->id)}}" class="btn btn-info btn-sm">Arquivo</a>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 text-left">
                                        <small class="text-muted text-left ml-2">{{$value->created_at->diffForHumans()}}</small>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <small class="text-muted text-right mr-2">IP: {{$value->ip_address}}</small>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="{{url('visualizar-cadastro/'.$value->id)}}" class="btn btn-success btn-sm mr-3" role="button">Vizualizar</a>
                                    <a href="{{url('editar-cadastro/'.$value->id)}}" class="btn btn-primary btn-sm mr-3" role="button">Editar</a>
                                    <a href="{{url('deletar-cadastro/'.$value->id)}}" onClick="deletar()" class="btn btn-danger btn-sm " role="button">Deletar </a>
                                </div>
                            </div>
                            </div>
                        @endforeach
                </div>
                <div class="row d-flex justify-content-center">
                    {{$cadastro->render()}}
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/cadastro.js') }}"></script>
@endsection
