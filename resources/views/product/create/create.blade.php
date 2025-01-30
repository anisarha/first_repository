<div class="card" id="card-create" style="display: none">
    <div class="card-body">
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" id="breadcrumbDaftarProduk">Daftar Produk</li>
                    <li class="breadcrumb-item text-dark" aria-current="page">Tambah Produk</li>
                </ol>
            </nav>

            <!-- Form -->
            <form id="create-product" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label" for="kategori">Kategori</label>
                        <select class="form-control" id="kategori" name="kategori">
                            <option value="">Pilih kategori</option>
                            <option value="Alat Olahraga">Alat Olahraga</option>
                            <option value="Alat Musik">Alat Musik</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="namaBarang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_product_create" name="nama_product_create"
                            placeholder="Masukkan nama barang">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="hargaBeli" class="form-label">Harga Beli</label>
                        <input type="text" class="form-control" id="harga_beli_create" name="harga_beli_create"
                            placeholder="Masukkan harga beli" oninput="formatRupiah(this)" />
                    </div>
                    <div class="col">
                        <label for="hargaJual" class="form-label">Harga Jual</label>
                        <input type="text" class="form-control" id="harga_jual_create" name="harga_jual_create"
                            placeholder="Masukkan harga jual" readonly />
                    </div>
                    <div class="col">
                        <label for="stokBarang" class="form-label">Stok Barang</label>
                        <input type="number" class="form-control" id="stokBarang" name="stokBarang"
                            placeholder="Masukkan jumlah stok barang">
                    </div>
                </div>

                <div class="upload-box border-1" onclick="document.getElementById('imageUpload').click();">
                    <img alt="Upload icon" height="80" src="{{ asset('backend/dist/images/Image.png') }}"
                        width="80" id="uploadedImage" />
                    <div id="fileName" style="margin-top: 10px; font-size: 14px;"></div>
                    <p>Upload gambar disini</p>
                    <input type="file" id="imageUpload" name="imageUpload" style="display:none;" accept="image/*"
                        onchange="previewImage(event)" />
                </div>

                <!-- Input untuk menyimpan base64 -->
                <input type="hidden" id="imageBase64" name="imageBase64" />


                <!-- Buttons aligned to the right -->
                <div class="d-flex justify-content-end gap-3 mt-3">
                    <button type="button" id="saveButton" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-outline-primary" onclick="clearForm()">Batalkan</button>
                </div>
            </form>

        </div>

    </div>
</div>
<script>
    // Fungsi untuk format input harga menjadi format Rupiah dengan simbol 'Rp'
    // Fungsi untuk format input harga menjadi format Rupiah dengan simbol 'Rp'
    function formatRupiah(input) {
        let num = input.value.replace(/[^0-9]/g, ''); // Hanya angka yang diizinkan
        let formatted = '';
        let sisa = num.length % 3;
        formatted = num.substr(0, sisa);
        let ribuan = num.substr(sisa).match(/\d{3}/g);
        if (ribuan) {
            let separator = sisa ? '.' : '';
            formatted += separator + ribuan.join('.');
        }
        input.value = 'Rp ' + formatted; // Tambahkan simbol 'Rp' di depan
        updateHargaJual(); // Perbarui harga jual setiap kali harga beli berubah
    }

    function updateHargaJual() {
        let hargaBeliElement = document.getElementById('harga_beli_create');
        let hargaJualElement = document.getElementById('harga_jual_create');

        // Hilangkan simbol dan titik dari nilai input harga beli
        let hargaBeli = hargaBeliElement.value.replace(/\D/g, '');
        hargaBeli = parseInt(hargaBeli);

        if (!isNaN(hargaBeli) && hargaBeli > 0) {
            // Hitung harga jual sebagai 30% lebih dari harga beli
            let hargaJual = hargaBeli + (hargaBeli * 0.30);
            hargaJual = Math.round(hargaJual); // Bulatkan harga jual
            hargaJualElement.value = formatCurrency(hargaJual);
        } else {
            hargaJualElement.value = ''; // Kosongkan jika harga beli tidak valid
        }
    }

    function formatCurrency(value) {
        // Format angka menjadi string dengan separator ribuan
        let num = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        return 'Rp ' + num;
    }




    // Preview dan validasi gambar
    function previewImage(event) {
        const file = event.target.files[0]; // Ambil file yang diunggah
        const output = document.getElementById('uploadedImage');
        const fileNameElement = document.getElementById('fileName');

        // Validasi jika file ada
        if (file) {
            // Validasi ukuran file (maksimal 100KB)
            if (file.size > 100 * 1024) {
                alert("Ukuran file terlalu besar! Maksimal ukuran file adalah 100KB.");
                event.target.value = ""; // Reset input file
                fileNameElement.textContent = "";
                output.src = "{{ asset('backend/dist/images/Image.png') }}"; // Reset gambar ke default
                document.getElementById('imageBase64').value = ""; // Reset base64
                return;
            }

            // Validasi format file (hanya JPG dan PNG)
            const allowedFormats = ['image/jpeg', 'image/png'];
            if (!allowedFormats.includes(file.type)) {
                alert("Format file tidak diizinkan! Hanya JPG dan PNG yang diperbolehkan.");
                event.target.value = ""; // Reset input file
                fileNameElement.textContent = "";
                output.src = "{{ asset('backend/dist/images/Image.png') }}"; // Reset gambar ke default
                document.getElementById('imageBase64').value = ""; // Reset base64
                return;
            }

            // Jika validasi berhasil, tampilkan preview gambar
            const reader = new FileReader();
            reader.onload = function() {
                output.src = reader.result; // Tampilkan gambar

                // Menyimpan base64 ke input hidden
                const base64String = reader.result.split(',')[1]; // Ambil bagian base64 setelah koma
                document.getElementById('imageBase64').value = base64String; // Menyimpan base64 ke input hidden

                // Tampilkan nama file
                fileNameElement.textContent = 'Nama file: ' + file.name;
            };
            reader.readAsDataURL(file);
        } else {
            // Reset jika tidak ada file
            fileNameElement.textContent = "";
            output.src = "{{ asset('backend/dist/images/Image.png') }}"; // Reset gambar ke default
            document.getElementById('imageBase64').value = ""; // Reset base64
        }
    }

    // Menambahkan event listener untuk tombol 'Simpan' dengan id 'saveButton'
    document.getElementById('saveButton').onclick = function() {
        var form = document.getElementById('create-product');
        var inputs = form.querySelectorAll('input, select');
        var isValid = true;

        // Melakukan validasi untuk memastikan semua field tidak kosong
        inputs.forEach(function(input) {
            if (input.value.trim() === '') {
                alert('Field "' + input.name + '" tidak boleh kosong.');
                input.focus();
                isValid = false;
                return false; // Berhenti pada field pertama yang kosong
            }
        });

        // Jika semua field valid, kirim form
        if (isValid) {
            // alert('lanjut ajax');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('create_data') }}",
                type: "POST",
                data: $('#create-product').serialize(),
                dataType: 'json',
                success: function(data) {

                    // pisi untuk sukses
                    clearForm();

                    // Show a success message using Swal (SweetAlert)
                    Swal.fire(
                        'Successfully!',
                        'Menambahkan data Barang!',
                        'success'
                    ).then(function() {
                        // Reload the DataTable with a slight delay to ensure the modal has completely hidden
                        setTimeout(function() {
                            $('#dataTable_product').DataTable().ajax.reload();
                        }, 500); // Adjust the delay as needed
                    });

                    // posisi untuk eror

                }
            });
        }
    };


    function clearForm() {
        // Ambil elemen form dengan ID 'create-product'
        const form = document.getElementById('create-product');

        // Reset semua input field ke nilai default (kosong)
        form.reset();

        // Clear the image preview if file input is used
        document.getElementById('imageUpload').value = ''; // Clear the file input
        document.getElementById('fileName').innerHTML = ''; // Clear the file name

        // Reset image preview but keep the default image
        const defaultImage = "{{ asset('backend/dist/images/Image.png') }}";
        const output = document.getElementById('uploadedImage');

        // Cek jika gambar sudah diubah (tergantung pada apakah fileBase64 sudah ada)
        if (document.getElementById('imageBase64').value !== "") {
            output.src = defaultImage; // Reset to default image
            document.getElementById('imageBase64').value = ""; // Reset base64
        }
    }
</script>
