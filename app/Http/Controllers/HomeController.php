<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movies;
use App\Models\Comentarios;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Movies $movies, Comentarios $comentarios)
    {
		$this->movies = $movies;
		$this->comentarios = $comentarios;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		if(Auth::check() == true ){
			$exibir_filmes = $this->movies->select()->get();
			return view('home')->with( [ "exibir_filmes" => $exibir_filmes ] );
		}else{
			return view('welcome');
		}
    }
	
	public function detalhes()
    {
		$exibir_filmes = $this->movies->select()->where("id", $_GET["id"])->get();
		$exibir_comentarios = $this->comentarios->listar($_GET["id"]);
        return view('detalhes')->with( [ "exibir_filmes" => $exibir_filmes, "exibir_comentarios" => $exibir_comentarios, "id_user" => Auth::user()->id ] );
    }
	
	public function comentar(Request $request)
    {
		$anonimo = 0;
		if(isset($request->anonimo))
			$anonimo = 1;
		
		$this->comentarios->insert([ "comentario" => $request->comentario, "usuario" => Auth::user()->id, "id_filme" => $request->id, "data" => date("Y-m-d H:i:s"), "anonimo" => $anonimo  ]);
        return back ();
    }
	
	public function atualizar(Request $request)
    {		
		$this->comentarios->where("id", $request->id_comentario)->update([ "comentario" => $request->comentario ]);
        return back ();
    }
	
	public function remover()
    {		
		$this->comentarios->where( ["id" => $_GET["id"], "usuario" => Auth::user()->id] )->delete();
        return back ();
    }
}
