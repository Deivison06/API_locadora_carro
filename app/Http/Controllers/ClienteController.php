<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Repositories\ClienteRepository;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    private $cliente;
    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clienteRepository = new ClienteRepository($this->cliente);

        if ($request->has('filtro')) {
            $clienteRepository->filtro($request->filtro);
        }

        if ($request->has('atributos')) {
            $clienteRepository->selectAtributos($request->atributos);
        }

        return response()->json($clienteRepository->getResultado(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->cliente->rules());

        $cliente = $this->cliente->create([
            'nome' => $request->nome,
        ]);

        return response()->json($cliente, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cliente = $this->cliente->find($id);

        if (!$cliente) {
            return response()->json(['error' => 'cliente não encontrada'], 404);
        }

        return response()->json($cliente, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cliente = $this->cliente->find($id);

        if ($request->method() === 'PATCH') {
            $regrasDinamicas = array();

            foreach ($cliente->rules() as $input => $regra) {

                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas);
        }
        else {
            $request->validate($cliente->rules());
        }

        $cliente->fill($request->all());
        $cliente->save();

        return response()->json($cliente, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cliente = $this->cliente->find($id);

        if (!$cliente) {
            return response()->json(['error' => 'Impossivel realizar a remoção. O recurso solicitado não existe'], 404);
        }

        $cliente->delete();
        return response()->json(['mensagem' => 'cliente removida com sucesso'], 200);
    }
}
