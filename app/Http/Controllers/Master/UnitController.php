<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Master\Unit;
use App\Repositories\BaseRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Master\MasterRequest;
use RealRashid\SweetAlert\Facades\Alert;

class UnitController extends Controller
{
    protected $model, $role;

    public function __construct(Unit $Unit) {
        $this->model = new BaseRepository($Unit);
    }

    public function index() {
        return view('master.unit.index');
    }

    public function getData() {
        $data = $this->model->query()->latest();
        return DataTables::of($data)
        ->addColumn('Action', function ($data) {
            return view(
                'layouts.component.action',
                [ 'model' => $data, 'url_edit' => route('unit.edit', $data->id), 'url_destroy' => route('unit.destroy', $data->id), 'menu' => 'Unit']
            );
        })
        ->addIndexColumn()
        ->rawColumns(['Action'])
        ->make(true);
    }

    public function create() {
        return view('master.unit.create');
    }

    public function store(Request $request) {
        try {
            $data = $request->except(['_token', '_method', 'id']);
            $this->model->store($data, true, ['image'], 'unit');
            Alert::toast($request->nama.' Berhasil Disimpan', 'success');
            return redirect()->route('unit.index');
        } catch (\Throwable $th) {
            Alert::toast($th->getMessage(), 'error');
            return back();
        }
    }

    public function edit($id) {
        try {
            $data['detail'] = $this->model->find($id);
            return view('master.unit.create', compact('data'));
        } catch (\Throwable $th) {
            Alert::toast($th->getMessage(), 'error');
            return redirect()->route('unit.index');
        }
    }

    public function update(Request $request) {
        try {
            $data =$request->except(['_token', '_method', 'id']);
            $this->model->update($request->id, $data);
            Alert::toast('Data Berhasil Dirubah', 'success');
            return redirect()->route('unit.index');
        } catch (\Throwable $th) {
            Alert::toast($th->getMessage(), 'error');
            return back();
        }
    }

    public function destroy($id) {
        try {
            $data = $this->model->softDelete($id);
            Alert::toast($data->nama.' Berhasil Dihapus', 'success');
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            Alert::toast($th->getMessage(), 'error');
            return redirect()->route('unit.index');
        }
    }
}
