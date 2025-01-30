<div class="card" id="card-edit" style="display: none">
    <div class="card-body">
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" id="breadcrumbDaftarProduk">Daftar Produk</li>
                    <li class="breadcrumb-item text-dark" aria-current="page">Edit Produk</li>
                </ol>
            </nav>

            <!-- Form -->
            <form id="edit-product" method="POST">
                @csrf
                <div class="row">
                    <!-- Input tersembunyi untuk menyimpan ID -->
                    <input type="hidden" id="id_edit" name="id_edit">
                    <div class="col-md-6">
                        <label class="form-label" for="kategori_edit">kategori_edit</label>
                        <select class="form-control" id="kategori_edit" name="kategori_edit">
                            <option value="">Pilih </option>
                            <option value="Alat Olahraga">Alat Olahraga</option>
                            <option value="Alat Musik">Alat Musik</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="namaproduct" class="form-label">Nama product</label>
                        <input type="text" class="form-control" id="nama_product_edit" name="nama_product_edit"
                            placeholder="Masukkan nama product">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="hargaBeli" class="form-label">Harga Beli</label>
                        <input type="text" class="form-control" id="harga_beli_edit" name="harga_beli_edit"
                            placeholder="Masukkan harga beli" oninput="formatRupiahedit(this)" />
                    </div>
                    <div class="col">
                        <label for="hargaJual" class="form-label">Harga Jual</label>
                        <input type="text" class="form-control" id="harga_jual_edit" name="harga_jual_edit"
                            placeholder="Masukkan harga jual" readonly />
                    </div>
                    <div class="col">
                        <label for="stok_edit" class="form-label">Stok product</label>
                        <input type="number" class="form-control" id="stok_edit" name="stok_edit"
                            placeholder="Masukkan jumlah stok product">
                    </div>
                </div>

                <div class="upload-box border-1" onclick="document.getElementById('image_upload_edit').click();">
                    <img alt="Upload icon" height="80" src="" width="80" id="upload_image_edit" />
                    <div id="file_name_edit" style="margin-top: 10px; font-size: 14px;"></div>
                    <p>Upload gambar disini</p>
                    <input type="file" id="image_upload_edit" name="image_upload_edit" style="display:none;"
                        accept="image/*" onchange="previewImageEdit(event)" />
                </div>

                <!-- Input untuk menyimpan base64 -->
                <input type="hidden" id="image_base64_edit" name="image_base64_edit" />


                <!-- Buttons aligned to the right -->
                <div class="d-flex justify-content-end gap-3 mt-3">
                    <button type="button" id="save_button_edit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-outline-primary" onclick="clearFormedit()">Batalkan</button>
                </div>
            </form>

        </div>

    </div>
</div>
<script>
    $(document).on('click', '.edit', function(e) {
        e.preventDefault();

        // Ambil ID elemen atau data lain yang dibutuhkan
        var id = $(this).attr('row-id');
        console.log('Edit button clicked for row ID:', id);

        // Masukkan ID ke dalam input hidden
        $('#id_edit').val(id);

        // Aktifkan card-edit
        $('#card-edit').show();

        // Tampilkan card-tbl
        $('#card-tbl').hide();
        $('#card-create').hide();

        // Panggil fungsi untuk mengedit data dengan ID yang sudah diambil
        Editdata(id);
    });

    function Editdata(id) {
        var route = "{{ route('get_edit_data', ':id') }}";
        route = route.replace(':id', id);

        $.ajax({
            url: route,
            method: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                // Debugging data untuk memastikan respons diterima
                console.log(data);

                // Ambil dan format data Base64 untuk gambar
                var imageBase64 = data.image; // Ambil data image Base64

                // Cek jika data.image tidak kosong
                if (imageBase64) {
                    // Format Base64 untuk ditampilkan di gambar preview
                    var formattedBase64 = `data:image/jpeg;base64,${imageBase64}`;

                    // Tampilkan gambar pada elemen <img> jika ada data Base64
                    $('#upload_image_edit').attr('src',
                        formattedBase64); // Tampilkan gambar di elemen <img>

                    // Menyimpan base64 ke input hidden
                    $('#image_base64_edit').val(
                        imageBase64); // Menyimpan data base64 tanpa bagian 'data:image/jpeg;base64,'

                    console.log("Formatted Base64:",
                        formattedBase64); // Debugging untuk melihat Base64 yang diformat
                } else {
                    // Jika data image kosong, tampilkan gambar default
                    $('#upload_image_edit').attr('src', '/path/to/default-image.jpg'); // Gambar default
                    console.error('Base64 image data is empty');
                }

                // Masukkan data lain ke input form
                $('#nama_product_edit').val(data.nama_produk);
                $('#kategori_edit').val(data.kategori);
                $('#harga_beli_edit').val(formatCurrency(data.harga_beli));
                $('#harga_jual_edit').val(formatCurrency(data.harga_jual));
                $('#stok_edit').val(data.stok);
            },
            error: function(xhr, status, error) {
                console.error("Error fetching data:", error);
            }
        });
    }

    // Fungsi formatCurrency untuk format angka menjadi format Rupiah
    function formatCurrency(value) {
        value = parseFloat(value).toFixed(0); // Hilangkan desimal
        return "Rp. " + value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Preview dan validasi gambar
    function previewImageEdit(event) {
        const file = event.target.files[0]; // Ambil file yang diunggah
        const output = document.getElementById('upload_image_edit'); // Elemen <img> untuk menampilkan gambar
        const fileNameElement = document.getElementById('file_name_edit'); // Elemen untuk menampilkan nama file
        const base64Input = document.getElementById('image_base64_edit'); // Input untuk menyimpan base64

        // Validasi jika file ada
        if (file) {
            // Validasi ukuran file (maksimal 100KB)
            if (file.size > 100 * 1024) {
                alert("Ukuran file terlalu besar! Maksimal ukuran file adalah 100KB.");
                event.target.value = ""; // Reset input file
                fileNameElement.textContent = "";
                output.src = ""; // Reset gambar
                base64Input.value = ""; // Reset base64
                return;
            }

            // Validasi format file (hanya JPG, PNG, dan JPEG)
            const allowedFormats = ['image/jpeg', 'image/png'];
            if (!allowedFormats.includes(file.type)) {
                alert("Format file tidak diizinkan! Hanya JPG, PNG, dan JPEG yang diperbolehkan.");
                event.target.value = ""; // Reset input file
                fileNameElement.textContent = "";
                output.src = ""; // Reset gambar
                base64Input.value = ""; // Reset base64
                return;
            }

            // Jika validasi berhasil, tampilkan preview gambar
            const reader = new FileReader();
            reader.onload = function() {
                // Tampilkan gambar pada elemen <img>
                output.src = reader.result;

                // Ambil base64 dan simpan ke input hidden
                const base64String = reader.result.split(',')[1]; // Ambil bagian base64 setelah koma
                base64Input.value = base64String; // Menyimpan base64 ke input hidden

                // Tampilkan nama file
                fileNameElement.textContent = 'Nama file: ' + file.name;
            };
            reader.readAsDataURL(file);
        } else {
            // Reset jika tidak ada file
            fileNameElement.textContent = "";
            output.src = ""; // Reset gambar
            base64Input.value = ""; // Reset base64
        }
    }

    function formatRupiahedit(angka) {
        let num = angka.value.replace(/[^0-9]/g, ''); // Hanya angka yang diizinkan
        let formatted = '';
        let sisa = num.length % 3;
        formatted = num.substr(0, sisa);
        let ribuan = num.substr(sisa).match(/\d{3}/g);
        if (ribuan) {
            let separator = sisa ? '.' : '';
            formatted += separator + ribuan.join('.');
        }
        angka.value = 'Rp ' + formatted; // Menambahkan simbol 'Rp' di depan
        // Setelah format, update harga jual berdasarkan harga beli
        updateHargaJualEdit();
    }

    // Fungsi untuk menghitung harga jual 30% dari harga beli
    function updateHargaJualEdit() {
        // Perbaiki ID untuk harga beli, menggunakan id="harga_beli_edit"
        let hargaBeli = document.getElementById('harga_beli_edit').value.replace(/\D/g,
            ''); // Hilangkan simbol dan titik
        hargaBeli = parseInt(hargaBeli);
        if (!isNaN(hargaBeli) && hargaBeli > 0) {
            let hargaJual = hargaBeli + (hargaBeli * 0.30); // Menghitung 30% lebih
            // Membulatkan harga jual ke angka bulat
            hargaJual = Math.round(hargaJual); // Bulatkan hasil perhitungan
            document.getElementById('harga_jual_edit').value = formatCurrency(
                hargaJual); // Perbaiki ID untuk harga jual
        } else {
            document.getElementById('harga_jual_edit').value = ''; // Kosongkan harga jual jika harga beli tidak valid
        }
    }

    function formatCurrency(value) {
        value = parseFloat(value).toFixed(0); // Hilangkan desimal
        return "Rp " + value.replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Tambahkan titik pemisah ribuan
    }

    // event function batalkan
    function clearFormedit() {
        // Ambil elemen form dengan ID 'create-product'
        // Aktifkan card-edit
        $('#card-edit').hide();

        // Tampilkan card-tbl
        $('#card-tbl').show();
        $('#card-create').hide();
    }

    // btn save / simpan
    $('#save_button_edit').on('click', function() {
        // Menampilkan alert sukses
        alert('Sukses masuk');

        // Ambil id dari input hidden
        var id = document.getElementById('id_edit').value;

        // Ganti :id dengan nilai id yang sebenarnya
        var route = "{{ route('edit_data', ':id') }}".replace(':id', id);

        // Melakukan AJAX request
        $.ajax({
            url: route,
            type: "POST",
            dataType: 'json',
            data: $('#edit-product').serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                // Jika response sukses
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Successfully!',
                        text: data.message, // Menggunakan pesan dari response
                        timer: 3000
                    }).then(function() {
                        // Sembunyikan card edit
                        $('#card-edit').hide();

                        // Tampilkan card-tbl
                        $('#card-tbl').show();
                        $('#card-create').hide();

                        // Reload data table setelah update
                        $('#dataTable_product').DataTable().ajax.reload();
                    });
                } else {
                    // Jika response gagal
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed!',
                        text: data.message ||
                        'Something went wrong!', // Pesan error dari response atau default
                    });
                }
            },
            error: function(xhr, status, error) {
                // Jika ada error di AJAX
                console.log(error); // Tampilkan error di console untuk debug
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'There was an issue with the request.',
                });
            }

        });
    });
</script>
