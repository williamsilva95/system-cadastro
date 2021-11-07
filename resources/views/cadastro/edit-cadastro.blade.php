@extends('main')
@section('content')
    <br><br>
    <div class="container mt-5 row d-flex justify-content-center">
        <br/>
        <div class="card col-md-6">
            <div class="card-body">
                <form action="{{url('editar-cadastro/'.$cadastro->id)}}" method="post" enctype="multipart/form-data" id="edit-cadastro">
                    {!! csrf_field() !!}

                    @if(session('erro'))
                        <div class="alert alert-danger">
                            {{session('erro')}}
                        </div>
                    @endif
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input name="name" type="text" class="form-control" id="name" required value="{{$cadastro->name}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control" id="email" required value="{{$cadastro->email}}">
                    </div>
                    <div class="form-group">
                        <label for="telephone">Telefone</label>
                        <input name="telephone" type="text" class="form-control" id="telephone" required onkeyup="mascaraFone(event)" value="{{$cadastro->telephone}}">
                    </div>
                    <div class="form-group">
                        <label for="message">Mensagem</label>
                        <textarea name="message" class="form-control" id="message" rows="4" required maxlength="250">{{$cadastro->message}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="file">Arquivo</label>
                        <input name="file" type="file" class="form-control-file" id="file" required value="{{$cadastro->file}}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm mr-3">Salvar</button>
                    <a href="{{url('lista-produto')}}" class="btn btn-light btn-sm border-dark" role="button">Voltar</a>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/cadastro.js') }}"></script>
@endsection
