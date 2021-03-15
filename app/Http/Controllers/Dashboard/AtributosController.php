<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Atributos;
use App\Models\AtributoValores;
use Illuminate\Http\Request;

class AtributosController extends Controller
{
    private $rqt;

    public function __construct(Request $request)
    {
        $this->rqt = $request;
    }

    public function index()
    {
        return view('Admin.atributos.index');
    }

    public function novo()
    {

    }

    public function postNovo()
    {
        $request = $this->rqt;

        try {
            beginTransaction();

            $atributo = Atributos::create(['nome' => $request->nome, 'empresa_id' => empresaId()]);

            foreach ($request->atributo_valores as $av) {
                $valores[] = new AtributoValores(['nome' => $av]);
            }

            $atributo->valores()->saveMany($valores);

            commit();

            return back()->with('success', 'Cadastro realizado com sucesso');
        } catch (\Exception $e) {
            rollback();
            return back()->with('erros', 'Não foi possível concluir a operação');
        }
    }
}
