$(document).ready(function () {
    var moduleList = new Tabulator("#user_priv-list", {
        columns: [
            { 
                title: "Aksi",
                field: "aksi",
                headerSort: false,
                formatter: function(cell, formatterParams, onRendered) {
                    var id = cell.getRow().getData().id;
                    return `
                        <button class="btn btn-primary btn-sm edit-btn" data-id="${id}" data-bs-toggle="modal" data-bs-target="#editModal">
                            <ion-icon name="create-outline"></ion-icon>
                        </button>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="${id}">
                            <ion-icon name="trash-outline"></ion-icon>
                        </button>`;
                },
                width: "20%",
            },
            { 
                title: "Nama Role", 
                field: "keterangan",
                sorter: true,
                width: "40%",
            },
            { 
                title: "Nama Module", 
                field: "nama_module",
                sorter: true,
                width: "40%",
            }
        ],
        ajaxURL: "/user_privs/api/data",
        ajaxConfig: "GET",
        pagination: "remote",
        paginationSize: 10,
        placeholder: "Data tidak tersedia",
    });

    $("#user_priv-list").on("click", ".edit-btn", function () {
        var id = $(this).data("id");
        console.log("Edit ID: " + id);
    
        // Ambil data 
        $.ajax({
            url: '/user_privs/api/data/' + id,
            method: 'GET',
            success: function (data) {
                // Memasukkan data ke dalam modal
                $("#editId").val(data.id);
                $("#editRole_id").val(data.role_id);  // Set value for role dropdown
                $("#editModule_id").val(data.module_id);  // Set value for module dropdown
    
                // Pastikan modal edit ditampilkan setelah data dimuat
                $('#editModal').modal('show');
            }
        });
    });
    
    

    $('#editModal').on('hidden.bs.modal', function () {
        // Reset dropdown to default value
        $("#role_id").val('');
        $("#module_id").val('');
    });

    // Ambil CSRF token dari meta tag
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    // Event handler untuk tombol hapus
    $("#user_priv-list").on("click", ".delete-btn", function () {
        var id = $(this).data("id");

        // Tampilkan SweetAlert untuk konfirmasi
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Lakukan penghapusan dengan Ajax dan sertakan token CSRF
                $.ajax({
                    url: '/user_privs/' + id,
                    method: 'DELETE', // Gunakan metode DELETE
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Sertakan token CSRF di sini
                    },
                    success: function (response) {
                        // Handle success response, misalnya reload tabel atau notifikasi
                        Swal.fire(
                            'Deleted!',
                            'Data telah dihapus.',
                            'success'
                        ).then(() => {
                            // Reload halaman setelah menghapus
                            location.reload();
                        });
                    },
                    error: function (xhr, status, error) {
                        // Handle error response jika diperlukan
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat menghapus data.',
                            'error'
                        );
                    }
                });
            }
        });
    });

});
