<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

trait ApiControllerTrait
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $notpaginate = true;

      if(isset($request->all()['paginate'])) {
        $notpaginate = false;
      }



      $limit = $request->all()['limit'] ?? 20;

      $fields = $request->all()['fields'] ?? '*';
      $groupBy = isset($request->all()['group']) ? explode(',',$request->all()['group']) : null;

      $order = $request->all()['order'] ?? null;

      $beteween = $request->all()['between'] ?? null;

      if($beteween){
        list($dataInicio, $dataFim) = explode(',', $beteween);
        $beteween = "created_at >= '$dataInicio 00:00' and created_at <= '$dataFim 23:59' ";
      }

      $beteweenTime = $request->all()['betweentime'] ?? null;
      if($beteweenTime){
          list($dataInicio, $dataFim) = explode(',', $beteweenTime);

          list($iniDate, $iniHora) = explode(' ', $dataInicio);
          list($iniDia, $iniMes, $iniAno) = explode('/', $iniDate);
          $dataInicio = $iniAno.'-'.$iniMes.'-'.$iniDia.' '.$iniHora;

          list($fimDate, $fimHora) = explode(' ', $dataFim);
          list($fimDia, $fimMes, $fimAno) = explode('/', $fimDate);
          $dataFim = $fimAno.'-'.$fimMes.'-'.$fimDia.' '.$fimHora;

          $beteweenTime = "created_at >= '$dataInicio' and created_at <= '$dataFim' ";
      }

      if ($order !== null) {
        $order = explode(',', $order);
      }

      $order[0] = $order[0] ?? $this->model->getKeyName();
      $order[1] = $order[1] ?? 'asc';

      $where = $request->all()['where'] ?? [];
      $in = $request->all()['in'] ?? [];

      $notnull = $request->all()['notnull'] ?? false;
      $null = $request->all()['null'] ?? false;

      $like = $request->all()['like'] ?? null;
      if ($like) {
        $like = explode(',', $like);
        $like[1] = '%' . $like[1] . '%';
      }

      $likeAll = $request->all()['likeall'] ?? false;
      $columns = $this->model->getFillable();

      $result = $this->model->select(DB::raw($fields))
        ->where(function($query) use ($like) {
          if ($like) {
            return $query->where($like[0], 'like', $like[1]);
          }
          return $query;
        });

      if($beteween){

        $result->whereRaw($beteween);
      }
      if($beteweenTime){
        $result->whereRaw($beteweenTime);
      }
      $result->with($this->relationships());

      if($notnull)
      $result->whereNotNull($notnull);
      if($null)
      $result->whereNull($null);

      if($likeAll){
      foreach($columns as $column)
      {
          $likeAll = '%' . $likeAll . '%';

          $result->orWhere(function($query) use ($column, $likeAll) {
          if ($likeAll) {
              return $query->where($column, 'like', $likeAll);
          }
          return $query;
          });
      }
      }

      if(!empty($where)){
        foreach ($where as $key => $value){
          $result->whereRaw($key . " = '" .$value."'");
        }
      }

      if(!empty($in)){
        foreach ($in as $key => $value){
          $result->whereRaw($key . " in (" .$value.")");
        }
      }

      $result->orderBy($order[0], $order[1]);

      // dd($result->toSql());

      if($groupBy)
          $result = $result->groupBy($groupBy);

      if($notpaginate){
        $result = $result->get($limit);
        return response()->json($result);
      } else {
        $result = $result->paginate($limit);
      }

      return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validators);
        $result = $this->model->create($request->all());
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->model->with($this->relationships())
          ->findOrFail($id);
        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result = $this->model->findOrFail($id);
        $result->update($request->all());
        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $result = $this->model->findOrFail($id);
      $result->delete();
      return response()->json($result);
    }

    protected function relationships()
    {
      if (isset($this->relationships)) {
        return $this->relationships;
      }
      return [];
    }
}
