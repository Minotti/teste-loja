<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Movimentacoes;
use App\Models\ProdutoEstoque;
use App\Models\Produtos;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ultimas_mov = Movimentacoes::take(5)->orderBy('created_at', 'desc')->get();
        $produtos = Produtos::with('estoque')->get();
        $usuarios = \Auth::user()->empresa->users->count();
        $estoque = 0;

        if($produtos->count() > 0) {
            $estoque = $produtos->map(function($est) {
                return $est->estoque->sum('qtd');
            })->sum();
        }

        $prod_count = $produtos->count();

        return view('home', compact('ultimas_mov', 'prod_count', 'estoque', 'usuarios'));
    }
}
