<?php

namespace App\Http\Controllers;

use App\Models\Pinjam;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;

class transaksi_pinjamb extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data = [
            'count_pinjam' => Pinjam::latest()->count(),
            'menu'       => 'menu.v_menu_admin',
            'content'    => 'content.view_pinjam',
            'title'    => 'Table pinjam'
        ];

        if ($request->ajax()) {
            $q_pinjam = Pinjam::select('*')->where('id', '!=', 0)
                ->orderByDesc('created_at');
            return Datatables::of($q_pinjam)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<div data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="btn btn-sm btn-icon btn-outline-success btn-circle mr-2 edit edit_pinjam"><i class=" fi-rr-edit"></i></div>';

                    $btn =  $btn . ' <div data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-sm btn-icon btn-outline-danger btn-circle mr-2 delete_pinjam"><i class="fi-rr-trash"></i></div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('layouts.v_template', $data);
    }

    public function show($id)
    {
        //
    }
    public function create($id)
    {
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|min:5',
            'gambar' => 'required|mimes:jpg,jpeg,png'
        ]);

        $file_name = $request->gambar->getClientOriginalName();
        $img = $request->gambar->storeAs('/buku', $file_name);
        $number = mt_rand(1000, 9999);
        $kodeBuku = 'BUK' . $number;

        if ($validator->fails()) {
            return Response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ), 400);
        } else {
            Pinjam::updateOrCreate(
                ['id' => $request->buku_id],
                [
                    'kode_buku' => $kodeBuku,
                    'judul' => $request->judul,
                    'deskripsi' => $request->deskripsi,
                    'pengarang' => $request->pengarang,
                    'penerbit' => $request->penerbit,
                    'tahunTerbit' => $request->tahunTerbit,
                    'gambar' => $img,
                    'jmlhHalaman' => $request->jmlhHalaman

                ]
            );
            return response()->json(['success' => 'buku berhasil disimpan ']);
        }
    }

    public function edit($id)
    {
        $buku = Pinjam::find($id);
        return response()->json($buku);
    }

    public function update(Request $request)
    {
    }

    public function destroy($id)
    {
        Pinjam::find($id)->delete();
        return response()->json(['success' => 'data berhasil didelete']);
    }
}
