<?php

namespace App\Http\Controllers\Empleado;

use App\EmpleadosDatosLab;
use App\Empleado;
use App\Area;
use App\Puesto;
use App\Sucursal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use UxWeb\SweetAlert\SweetAlert;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $empleados = new Empleado;

        /**
         * Si se realizó una consulta buscamos las palabras
         * que concuerden con dicah consulta.
         */
        if ($request->input('query')) {
            $empleados = $empleados->findByText($request->input('query'));
        }

        $empleados = $empleados->activos()->sortable()->paginate(10);
        return view('empleado.index', ['empleados' => $empleados]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleado = new Empleado();
        $edit = false;
        return view('empleado.create', ['empleado' => $empleado, 'edit' => $edit]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'unique:empleados',
            'rfc' => 'unique:empleados',
        ]);

        if ($validator->fails()) {
            SweetAlert::error($validator->errors()->first());
            return redirect()->back();
        }

        $empleado = Empleado::create($request->all());
        return redirect()->route('empleados.show', ['empleado' => $empleado])->with('success', 'Empleado Creado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Empleado $empleado)
    {

        /**
         * Si el empleado tiene una cuenta de usuario,
         * la eliminamos
         */

        if ($empleado->user()->first()) {
            $empleado->user()->first()->delete();
        }

        /**
         * Eliminamos al empleado
         */

        $empleado->status = "eliminado";
        $empleado->save();
        return $this->index($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {

        return view('empleado.view', ['empleado' => $empleado]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        $edit = true;
        return view('empleado.create', ['empleado' => $empleado, 'edit' => $edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'unique:empleados,email,' . $empleado->id,
            'rfc' => 'unique:empleados,rfc,' . $empleado->id,
        ]);

        if ($validator->fails()) {
            SweetAlert::error($validator->errors()->first());
            return redirect()->back();
        }

        $empleado->update($request->all());
        return redirect()->route('empleados.show', ['empleado' => $empleado])->with('success', 'Empleado Actualizado');
    }

    public function getEmpleado($id)
    {
        $empleado = Empleado::find($id);
        return response()->json($empleado);
    }

    //Añadido : Iyari 05/Dic/2017
    public function consulta()
    {
        return view('empleado.consulta');
    }

    public function buscar(Request $request)
    {

        $query = $request->input('busqueda');
        $wordsquery = explode(' ', $query);
        $empleados = Empleado::where(function ($q) use ($wordsquery) {
            foreach ($wordsquery as $word) {
                # code...
                $q->orWhere('nombre', 'LIKE',      "%$word%")
                    ->orWhere('appaterno', 'LIKE', "%$word%")
                    ->orWhere('apmaterno', 'LIKE', "%$word%")
                    ->orWhere('rfc', 'LIKE',     "%$word%");
            }
        })->get();
        return view('empleado.busqueda', ['empleados' => $empleados]);
    }
}
