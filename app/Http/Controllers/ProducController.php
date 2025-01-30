<?php

namespace App\Http\Controllers;

use App\Exports\ExportProduk;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ProducController extends Controller
{
    //
    public function index_product()
    {
        return view('product.index');
    }
    public function get_datatables_product(Request $request)
    {
        // dd($request);
        if ($request->ajax()) {
            $kategori = $request->input('kategori'); // Ambil kategori dari request
            $namaProduk = $request->input('nama_produk'); // Ambil nama_produk dari request

            $query = Product::select(
                'id',
                'image',
                'nama_produk',
                'kategori',
                'harga_jual',
                'harga_beli',
                'stok'
            )
                ->orderByDesc('created_date')
                ->whereNull('void_date')
                ->where('status', 'ACTIVE');

            // Filter kategori jika ada
            if (!empty($kategori)) {
                $query->where('kategori', $kategori);
            }

            // Filter nama_produk jika ada
            if (!empty($namaProduk)) {
                $query->where('nama_produk', 'LIKE', '%' . $namaProduk . '%');
            }

            $data = $query->get();

            // dd($data);
            // return response()->json($data);


            // dd($data);
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('DT_RowIndex', function ($data) {
                    return $data->DT_RowIndex;
                })
                ->rawColumns(['action'])
                ->editColumn('action', function ($data) {
                    return view('product.action_datatables.action_product', [
                        'model' => $data,
                        // 'url_print' => route('tms.warehouse.stock_out_entry_report', base64_encode($data->jmesin))
                    ]);
                })
                ->make(true);
        }
    }

    public function create_data(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        // Ambil data dari input
        $createdBy = Auth::user()->name; // Asumsi Anda menggunakan Auth untuk mendapatkan user yang sedang login
        $createdDate = Carbon::now('Asia/Jakarta')->toDateString();

        // Ambil dan bersihkan nilai harga beli dan harga jual
        $hargaBeli = $request->input('harga_beli_create');
        $hargaBeli = (int) preg_replace('/\D/', '', $hargaBeli); // Hanya ambil angka
        $hargaJual = $request->input('harga_jual_create');
        $hargaJual = (int) preg_replace('/\D/', '', $hargaJual); // Hanya ambil angka

        // Simpan data ke database
        $product = Product::create([
            'kategori' => $request->input('kategori'),
            'nama_produk' => $request->input('nama_product_create'),
            'harga_beli' => $hargaBeli, // Hanya angka, tanpa "Rp"
            'harga_jual' => $hargaJual, // Hanya angka, tanpa "Rp"
            'stok' => $request->input('stokBarang'),
            'image' => $request->input('imageBase64'), // Menyimpan base64 ke database
            'status' => 'ACTIVE',          // Menambahkan status ACTIVE
            'created_by' => $createdBy,    // Menambahkan ID pengguna yang membuat
            'created_date' => $createdDate // Menambahkan tanggal pembuatan
        ]);

        // Kembalikan respons JSON sukses
        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan']);
    }
    public function void_data(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            // Retrieve the ID from the request
            $id = $request->id;

            // Update the product's status and void date
            $product = Product::where('id', $id)->update([
                'status' => 'NOT ACTIVE',
                'void_date' => now(), // Use Laravel's helper for the current date/time
            ]);

            if ($product) {
                // If the update was successful
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil dihapus.',
                ]);
            } else {
                // If no rows were affected
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan.',
                ], 404);
            }
        } catch (\Exception $e) {
            // Handle any exceptions
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function get_edit_data(Request $request)

    {
        // dd($request->id);
        $id = (int) $request->id;
        $get_product = Product::where('id', $id)
            ->select(
                'nama_produk',
                'image',
                'kategori',
                'harga_beli',
                'harga_jual',
                'stok'
            )
            ->first();
        // dd($get_product);
        echo json_encode($get_product);
        exit;
        return response()->json($get_product);
    }

    public function edit_data(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        // Validasi input
        $request->validate([
            'id_edit' => 'required|integer',
            'nama_product_edit' => 'required|string|max:255',
            'harga_beli_edit' => 'required|string',
            'harga_jual_edit' => 'required|string',
            'stok_edit' => 'required|integer',
            'image_base64_edit' => 'nullable|string'
        ]);

        $id = (int) $request->input('id_edit');
        $kategoriEdit = $request->input('kategori_edit');
        $namaProductEdit = $request->input('nama_product_edit');
        $hargaBeliEdit = $request->input('harga_beli_edit');
        $hargaBeliEdit = (int) preg_replace('/\D/', '', $hargaBeliEdit); // Hanya ambil angka
        $hargaJualEdit = $request->input('harga_jual_edit');
        $hargaJualEdit = (int) preg_replace('/\D/', '', $hargaJualEdit); // Hanya ambil angka
        $stokEdit = $request->input('stok_edit');
        $imageBase64Edit = $request->input('image_base64_edit');
        $updateDate = Carbon::now('Asia/Jakarta')->toDateString();
        $updateBy = Auth::user()->name;

        // Debug input data
        // dd(compact('id', 'kategoriEdit', 'namaProductEdit', 'hargaBeliEdit', 'hargaJualEdit', 'stokEdit', 'imageBase64Edit'));

        // Update produk
        $product = Product::where('id', $id)->update([
            'nama_produk' => $namaProductEdit,
            'image' => $imageBase64Edit,
            'kategori' => $kategoriEdit,
            'harga_beli' => $hargaBeliEdit,
            'harga_jual' => $hargaJualEdit,
            'stok' => $stokEdit,
            'updated_by' => $updateBy,
            'update_date' => $updateDate
        ]);

        if ($product) {
            return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui']);
        } else {
            return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan atau gagal diupdate']);
        }
    }
    public function export_excel_product(Request $request)
    {
        // Ambil data filter dari request
        $kategori = $request->input('kategori');
        $nama_produk = $request->input('nama_produk');

        // Query data dengan filter
        $query = Product::select('nama_produk', 'kategori', 'harga_beli', 'harga_jual', 'stok')
            ->whereNull('void_date')
            ->where('status', 'ACTIVE');

        if ($kategori) {
            $query->where('kategori', $kategori);
        }
        if ($nama_produk) {
            $query->where('nama_produk', 'LIKE', "%$nama_produk%");
        }

        $data = $query->get();

        // Export data ke Excel
        return Excel::download(new ExportProduk($data), 'data-produk.xlsx');
    }
}
