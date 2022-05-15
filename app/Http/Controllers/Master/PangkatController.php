<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Master\Pangkat;
use App\Repositories\BaseRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Master\MasterRequest;
use RealRashid\SweetAlert\Facades\Alert;

class PangkatController extends Controller
{
    protected $model, $role;

    public function __construct(Pangkat $Pangkat) {
        $this->model = new BaseRepository($Pangkat);
    }

    public function index() {
        return view('master.pangkat.index');
    }

    public function getData() {
        $data = $this->model->query()->latest();
        return DataTables::of($data)
        ->addColumn('Action', function ($data) {
            return view(
                'layouts.component.action',
                [ 'model' => $data, 'url_edit' => route('pangkat.edit', $data->id), 'url_destroy' => route('pangkat.destroy', $data->id), 'menu' => 'Pangkat']
            );
        })
        ->addIndexColumn()
        ->rawColumns(['Action'])
        ->make(true);
    }

    public function create() {
        return view('master.pangkat.create');
    }

    public function store(Request $request) {
        try {
            $data = $request->except(['_token', '_method', 'id']);
            $this->model->store($data, true, ['image'], 'pangkat');
            Alert::toast($request->nama.' Berhasil Disimpan', 'success');
            return redirect()->route('pangkat.index');
        } catch (\Throwable $th) {
            Alert::toast($th->getMessage(), 'error');
            return back();
        }
    }

    public function edit($id) {
        try {
            $data['detail'] = $this->model->find($id);
            return view('master.pangkat.create', compact('data'));
        } catch (\Throwable $th) {
            Alert::toast($th->getMessage(), 'error');
            return redirect()->route('pangkat.index');
        }
    }

    public function update(Request $request) {
        try {
            $data =$request->except(['_token', '_method', 'id']);
            $this->model->update($request->id, $data);
            Alert::toast('Data Berhasil Dirubah', 'success');
            return redirect()->route('pangkat.index');
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
            return redirect()->route('pangkat.index');
        }
    }
}
