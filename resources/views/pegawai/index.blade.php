<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>

<body class="bg-secondary">
    <main class="container">
        <!-- START FORM -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <form action='' method='post'>
                <div class="mb-3 row">
                    <label for="namaEdit" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='namaEdit' id="namaEdit">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="emailEdit" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='emailEdit' id="emailEdit">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="button" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10"><button type="button" class="btn btn-primary" name="button">SIMPAN</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- AKHIR FORM -->

        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <!-- TOMBOL TAMBAH DATA -->
            <div class="pb-3">
                <a href='' class="btn btn-primary tombol-tambah" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">+ Tambah
                    Data</a>
            </div>
            <table class="table table-striped table-bordered" id="myTable">
                <thead class="bg-primary">
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-5">Nama</th>
                        <th class="col-md-4">Email</th>
                        <th class="col-md-2">Aksi</th>
                    </tr>
                </thead>
            </table>

        </div>
        <!-- AKHIR DATA -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">New Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="col-form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email"></input>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary tombol-simpan">Save</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal --}}
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                processing: true,
                serverside: true,
                ajax: "{{ url('pegawaiAjax') }}",
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                }, {
                    data: 'nama',
                    name: 'Nama'
                }, {
                    data: 'email',
                    name: 'Email'
                }, {
                    data: 'aksi',
                    name: 'Aksi'
                }]
            });
        });

        // GLOBAL SETUP 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // 02_PROSES SIMPAN 
        $('body').on('click', '.tombol-tambah', function(e) {
            e.preventDefault();
            $('#exampleModal').modal('show');
            $('.tombol-simpan').click(function() {
                simpan()
            });
        });

        function simpan() {
            //define variable
            let nama = $('#nama').val();
            let email = $('#email').val();
            let token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                type: "post",
                url: "{{ url('pegawaiAjax') }}",
                data: {
                    "nama": nama,
                    "email": email,
                    "_token": token
                },
                success: function(response) {
                    $('#myTable').DataTable().ajax.reload();

                    //clear form
                    $('#nama').val('');
                    $('#email').val('');

                    //close modal
                    $('#exampleModal').modal('hide');
                }
            });
        }
    </script>
</body>

</html>
