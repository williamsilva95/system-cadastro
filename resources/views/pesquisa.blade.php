@extends('main')

@section('content')
    <div class="container mt-4">
        <br/>
        <div class="card">
            <div class="card-header text-right">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <a href="{{url('criar-cadastro')}}" class="btn btn-primary btn-sm" role="button">Novo Cadastro</a>
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
                        <div class="card text-center ml-3 mb-5">
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
                                    <small class="text-muted text-left ml-4">{{$value->created_at->diffForHumans()}}</small>
                                </div>
                                <div class="col-md-6 ">
                                    <small class="text-muted text-right">IP: {{$value->ip_address}}</small>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{url('visualizar-cadastro/'.$value->id)}}" class="btn btn-success btn-sm mr-3" role="button">Vizualizar</a>
                            </div>
                        </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/cadastro.js') }}"></script>
@endsection
