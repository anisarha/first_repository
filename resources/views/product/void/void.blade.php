<script>
    $(document).on('click', '.voided', function(e) {
        e.preventDefault();

        // Get the row ID and product name
        var id = $(this).attr('row-id');
        var product = $(this).attr('data-id');

        // Show SweetAlert confirmation
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: 'Apakah Anda yakin menghapus data ini: ' + product + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                // Send AJAX request to delete the product
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('void_data') }}", // Update this with your route
                    type: 'POST',
                    data: {
                        id: id // Only pass the ID
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response
                            .message, // Display success message from the server
                            icon: 'success',
                        });
                        // Reload the DataTable
                        $('#dataTable_product').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        let errorMessage = xhr.responseJSON ? xhr.responseJSON.message :
                            'Terjadi kesalahan saat menghapus data.';
                        Swal.fire({
                            title: 'Gagal!',
                            text: errorMessage, // Display error message from the server
                            icon: 'error',
                        });
                    }

                });
            } else {
                Swal.fire({
                    title: 'Batal',
                    text: 'Data tidak jadi dihapus.',
                    icon: 'info',
                });
            }
        });
    });
</script>
