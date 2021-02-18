@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de Filmes</div>
				@foreach($exibir_filmes as $filmes)
					<div class="card-body">
						<table>
						<tr> <td colspan=2> <h3>{{ $filmes->titulo }}</h3> </td> </tr>
						<tr> 
							<td> <img src="{{ $filmes->imagem }}" /> </td> 
							<td> <b> Sinopse</b><br>{{ $filmes->descricao_breve }} <br><a href="{{ url( 'filme' ) }}?id={{$filmes->id}}"> Ver detalhes </a> </td> 
						</tr>
						
						</table>
					</div>
				@endforeach
            </div>
        </div>
    </div>
</div>
@endsection
