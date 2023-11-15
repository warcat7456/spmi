<?php

namespace App\Http\Controllers;

use App\Periode;
use App\Helpers\DataStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Exception;

class PeriodeController extends Controller
{
    public function index(Periode $periode)
    {
        return view('periode.index', [
            'periode' => $periode->all(),
        ]);
    }

    public function getData(Request $request)
    {
        try {
            $data = DataStructure::keyValue(Periode::get()->toArray(), 'id');
            return  $this->Response($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $att = $request->input();
            $id = Periode::create($att)->id;
            $data = Periode::where('id', $id)->get()->first();
            $this->Response($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }

    public function put(Request $request)
    {

        try {
            $att = $request->input();
            $data = Periode::find($request->id);
            $data->update($att);
            $this->Response($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }

    public function delete(Request $request)
    {

        try {
            $att = $request->input();
            $data = Periode::where('id', $request->id)->delete();
            $this->Response($data);
        } catch (Exception $ex) {
            return  $this->ResponseError($ex->getMessage());
        }
    }
}
