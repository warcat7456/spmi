<?php

namespace App\Http\Controllers;

use App\Jenjang;
use App\Kriteria;
use App\Lembaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KriteriaController extends Controller
{
    public function index(Request $req)
    {
        $filter = [
            'lembaga_id' => $req->input('flembaga_id', 1),
            'jenjang_id' => $req->input('fjenjang_id', 1),
            'level' => $req->input('flevel'),
        ];

        $kriteria = Kriteria::getFilteredWithChildren($filter);
        $lembaga = Lembaga::all();
        $jenjang = Jenjang::all();

        return view('kriteria.index', compact('kriteria', 'lembaga', 'filter', 'jenjang'));
    }

    public function show($jenjang)
    {
        $j = Jenjang::where('kode', $jenjang)->firstOrFail();
        return view('kriteria.index', ['j' => $j]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'level' => 'required|integer|min:1|max:4',
            'sjenjang_id' => 'required|exists:jenjangs,id',
            'lembaga_id' => 'required|exists:lembaga,id',
            'parent_kriteria' => 'required_if:level,2,3,4',
            'code' => 'required|string|max:10|unique:kriteria,kode',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            $kriteria = new Kriteria();
            $kriteria->name = $request->name;
            $kriteria->kode = $request->code;
            $kriteria->level = $request->level;
            $kriteria->parent_id = $request->parent_kriteria ?? null;
            $kriteria->lembaga_id = $request->lembaga_id;
            $kriteria->jenjang_id = $request->sjenjang_id;
            $kriteria->save();

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Kriteria created successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'An error occurred while creating the kriteria: ' . $e->getMessage()], 500);
        }
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:kriteria,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            $kriteria = Kriteria::findOrFail($request->id);
            $kriteria->delete();

            DB::commit();

            return response()->json(['message' => 'Kriteria deleted successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while deleting the kriteria: ' . $e->getMessage()], 500);
        }
    }

    public function parent(Request $req)
    {
        if (!$req->ajax()) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException('Request must be an ajax request');
        }

        try {
            $filter = [
                'lembaga_id' => $req->input('flembaga_id', 1),
                'jenjang_id' => $req->input('fjenjang_id', 1),
                'level' => $req->input('flevel'),
            ];

            $kriteria = Kriteria::getFilteredWithChildren($filter);

            return response()->json(['kriteria' => $kriteria], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
