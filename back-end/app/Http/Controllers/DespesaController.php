<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDespesaRequest;
use App\Http\Requests\UpdateDespesaRequest;
use App\Http\Resources\DespesaResource;
use App\Models\Despesa;
use App\Repositories\DespesaRepository;
use Exception;

class DespesaController extends Controller
{
    protected $despesaRepository;

    public function __construct(DespesaRepository $despesaRepository)
    {   
        $this->despesaRepository = $despesaRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $despesas = $this->despesaRepository->all();

            return $this->sendResponse(DespesaResource::collection($despesas));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), null, 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDespesaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDespesaRequest $request)
    {
        try {
            $dados = $request->all();

            $nova_despesa = $this->despesaRepository->create($dados);

            return $this->sendResponse(new DespesaResource($nova_despesa), null, 201);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), null, 400); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $despesa = $this->despesaRepository->find_by_id($id);

            return $this->sendResponse(new DespesaResource($despesa));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), null, 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDespesaRequest  $request
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDespesaRequest $request, $id)
    {
        try {
            $dados = $request->all();

            $despesa_atualizada = $this->despesaRepository->update($dados, $id);

            return $this->sendResponse(new DespesaResource($despesa_atualizada));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), null, 400); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->despesaRepository->delete($id);

            return $this->sendResponse(null, 'Registro excluído com sucesso', 200);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), null, 400); 
        }
    }
}
