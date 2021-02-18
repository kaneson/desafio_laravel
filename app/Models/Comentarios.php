<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Filmes;

class Comentarios extends Filmes
{
    protected $table = "comentarios";

	 public function listar ($id_filme)
    {
		$exibir = self::selectRaw("comentarios.id, comentario, data, anonimo, users.id as usuario, users.name");
		$exibir->LeftJoin("users", "users.id", "=", "comentarios.usuario");
		$exibir->where("id_filme", $id_filme);
		
		return $exibir->orderBy("comentarios.data", "desc")->get ();
    }
	
	
}