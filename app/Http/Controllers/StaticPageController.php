<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateStaticPageRequest;
use App\StaticPage;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('static-page.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StaticPage  $staticPage
     * @return \Illuminate\Http\Response
     */
    public function show($staticPage)
    {
        $page = StaticPage::where('slug', $staticPage)->first();
        if (!$staticPage) {
            abort(404);
        }
        return view('home.profil', ['page' => $page]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StaticPage  $staticPage
     * @return \Illuminate\Http\Response
     */
    public function edit(StaticPage $staticPage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StaticPage  $staticPage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStaticPageRequest $request, StaticPage $halaman)
    {
        $halaman->update($request->validated());

        return redirect()->route('halaman.index')
            ->with('success', 'Berhasil mengupdate data halaman');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StaticPage  $staticPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaticPage $halaman)
    {
        $halaman->delete();

        return redirect()->route('halaman.index')
            ->with('success', 'Berhasil menghapus halaman ' . $halaman->title);
    }
    public function datatable(Request $request)
    {
        $query = StaticPage::query(); // Replace YourModel with your actual Eloquent model

        // Handle search
        if ($request->filled('search.value')) {
            $searchValue = $request->input('search.value');
            $query->where(function ($query) use ($searchValue) {
                $query->where('title', 'like', '%' . $searchValue . '%')
                    ->orWhere('slug', 'like', '%' . $searchValue . '%')
                    ->orWhere('content', 'like', '%' . $searchValue . '%');
            });
        }

        // Handle sorting
        if ($request->has('order.0.column')) {
            $orderColumn = $request->input('columns')[$request->input('order.0.column')]['data'];
            $orderDirection = $request->input('order.0.dir');
            $query->orderBy($orderColumn, $orderDirection);
        }

        // Get the total count before applying pagination
        $totalRecords = $query->count();

        // Apply pagination
        $query->skip($request->input('start'))->take($request->input('length'));

        $data = $query->get();

        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data,
        ]);
    }
}
