@extends('layouts.admin')
@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 20px;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: '>';
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            margin-bottom: 20px;
        }

        .upload-box {
            border: 2px dashed #d9d9d9;
            padding: 40px;
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
            position: relative;
        }

        .upload-box img {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

        .upload-box p {
            margin: 0;
        }

        .upload-box .dot {
            height: 8px;
            width: 8px;
            background-color: red;
            border-radius: 50%;
            display: inline-block;
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
    <div class="col-12">
        <div class="main-content-inner">
            <div class="row">
                <div class="col-12 text-left mt-2">
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-2">
                    <div class="card" id="card-tbl">
                        <div class="card-body">
                            <h4 class="header-title bold">DAFTAR PRODUK</h4>
                            <div class="data-tables">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row align-items-center justify-content-between">
                                        <!-- Left input and select -->
                                        <div class="col-md-4 d-flex gap-3"> <!-- Increased gap between input and select -->
                                            <input type="text" id="search-produk" class="form-control form-control-sm"
                                                placeholder="Cari Produk">&nbsp;
                                            <select id="category-select" class="form-control form-control-sm">
                                                <option value="">Semua</option>
                                                <option value="Alat Olahraga">Alat Olahraga</option>
                                                <option value="Alat Musik">Alat Musik</option>
                                            </select>
                                        </div>

                                        <!-- Buttons for Export and Add Data -->
                                        <div class="col-md-auto d-flex gap-3"> <!-- Increased gap between buttons -->
                                            <button class="btn btn-success btn-sm px-4" id="exportExcelproduct">Export
                                                Excel</button>
                                            &nbsp;
                                            <button class="btn btn-danger btn-sm px-4" id="btn-tambah-data">Tambah
                                                Data</button>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-sm-12">
                                            <table id="dataTable_product"
                                                class="text-center dataTable no-footer dtr-inline collapsed" role="grid"
                                                aria-describedby="dataTable_info">
                                                <thead class="bg-light text-capitalize">
                                                    <tr role="row">
                                                        <th width="5%">No</th>
                                                        <th width="20%">Image</th>
                                                        <th width="20%">Nama Produk</th>
                                                        <th width="15%">Kategori Product</th>
                                                        <th width="15%">Harga Beli (Rp) </th>
                                                        <th width="15%">Harga Jual (Rp) </th>
                                                        <th width="15%">Stok Produk</th>
                                                        <th width="10%">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('product.create.create')
                    @include('product.edit.edit')
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    @include('product.void.void')
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#dataTable_product').DataTable({
                processing: true,
                serverSide: true,
                deferRender: true,
                responsive: true,
                ajax: {
                    url: "{{ route('get_datatables_product') }}",
                    data: function(d) {
                        d.kategori = $('#category-select').val(); // Kategori filter
                        d.nama_produk = $('#search-produk').val(); // Pencarian nama produk
                    }
                },
                language: {
                    processing: '<i class="fa fa-duotone fa-spinner fa-spin fa-4x"></i> Loading...',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'No',
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'image',
                        className: "text-center",
                        render: function(data) {
                            return '<img src="data:image/jpeg;base64,' + (data ||
                                    'default-base64-string') +
                                '" alt="Product Image" style="width: 50px; height: 50px; object-fit: cover;" />';
                        }
                    },
                    {
                        data: 'nama_produk',
                        className: "text-left"
                    },
                    {
                        data: 'kategori',
                        className: "text-center"
                    },
                    {
                        data: 'harga_beli',
                        className: "text-left",
                        render: function(data) {
                            return formatRupiah(data !== null ? data : 0);
                        }
                    },
                    {
                        data: 'harga_jual',
                        className: "text-center",
                        render: function(data) {
                            return formatRupiah(data !== null ? data : 0);
                        }
                    },
                    {
                        data: 'stok',
                        className: "text-center"
                    },
                    {
                        data: 'action',
                        className: "text-center"
                    }
                ],
                dom: "tip", // Remove "Show Entries" and length menu
            });
            $('#category-select').on('change', function() {
                table.ajax.reload(); // Reload DataTables dengan parameter kategori baru
            });
            $('#search-produk').on('input', function() {
                table.ajax.reload(); // Reload DataTables dengan filter nama produk baru
            });




            // Helper function to format currency
            function formatRupiah(amount) {
                return 'Rp ' + new Intl.NumberFormat('id-ID').format(amount);
            }

            // Format number to Rupiah
            function formatRupiah(angka) {
                var formatter = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                });

                var formattedString = formatter.format(angka);
                return formattedString.replace("Rp. ", ""); // Remove "Rp." prefix
            }
        });

        document.getElementById('btn-tambah-data').addEventListener('click', function() {
            // Sembunyikan card-tbl
            document.getElementById('card-tbl').style.display = 'none';
            // Tampilkan card-create
            document.getElementById('card-create').style.display = 'block';
        });
        $('#exportExcelproduct').on('click', function() {
            // Ambil data filter dari DataTables
            let kategori = $('#category-select').val();
            let nama_produk = $('#search-produk').val();

            // Kirimkan data ke server menggunakan form submit
            let form = $('<form>', {
                method: 'POST',
                action: "{{ route('export_excel_product') }}",
            });

            form.append($('<input>', {
                name: '_token',
                value: "{{ csrf_token() }}",
                type: 'hidden'
            }));
            form.append($('<input>', {
                name: 'kategori',
                value: kategori,
                type: 'hidden'
            }));
            form.append($('<input>', {
                name: 'nama_produk',
                value: nama_produk,
                type: 'hidden'
            }));

            $('body').append(form);
            form.submit();
        });
    </script>
@endsection('content')
