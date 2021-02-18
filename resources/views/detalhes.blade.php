@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row ">
        <div class="col-md-12">
            <a href="home"> <img src="img/back.png" width="5%"> </a>
        </div>
    </div>
	<br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
				@foreach($exibir_filmes as $filmes)
					<div class="card-body">
						<h2>{{ $filmes->titulo }}</h2> 
						<img src="{{ $filmes->imagem }}" /> <br> 
						<b> Sinopse</b><br>{{ $filmes->descricao }} 
					</div>
				@endforeach
            </div>
        </div>
    </div>
		<br />
	<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Divulgar comentário</div>
				<form action="{{ url( 'comentar' ) }}" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="card-body">
						<input type="checkbox" name="anonimo"><label> Publicar no modo anônimo </label>
						<textarea name="comentario" class="form-control" required ></textarea><br>
						<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
						<input type="submit" class='btn btn-block btn-primary' style="width:10%" value="Postar">
					</div>
				</form>
            </div>
        </div>
    </div>
	
	<br />
	<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Comentários</div>
				@foreach($exibir_comentarios as $comentarios)
					<div class="card-body">
					<b>
					@if($comentarios->anonimo == 1)
						Usuário Anônino
					@else
						{{ $comentarios->name }}
					@endif
					</b> <br>
					<font size=1>{{ date("d/m/Y H:i", strtotime($comentarios->data)) }}</font> 
					@if($comentarios->usuario == $id_user)
					- <a href="#" data-toggle='modal' data-target="#edit{{$comentarios->id}}"> Editar </a> - <a href="{{ url( 'remover' ) }}?id={{ $comentarios->id }}" onclick="return confirm('O COMENTÁRIO SERÁ REMOVIDO! DESEJA CONTINUAR?');"> Remover </a>
					@endif
					<p> {{ $comentarios->comentario }} </p>
					
					</div>

				@endforeach
            </div>
        </div>
    </div>
</div>
@foreach($exibir_comentarios as $comentarios)

	<form action="{{ url( 'edit' ) }}"  method="post" enctype="multipart/form-data"  >
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="id_comentario" value="{{ $comentarios->id }}">
		<div class="modal fade" id="edit{{$comentarios->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Comentário </h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</div>

					<div class="modal-body">
						<textarea class="form-control" name="comentario" required>{{ $comentarios->comentario }}</textarea>

					</div>

					<div class="modal-footer">
						<a class="btn btn-danger" data-dismiss="modal">Fechar</a>
						<input type="submit" class="btn btn-success" value='Atualizar' name="atualizar" />
					</div>

				</div>
			</div>
		</div>
	</form>
@endforeach
@endsection
