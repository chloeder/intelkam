<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INTELKAM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <h1 class="text-center mb-4">Data Pegawai</h1>

    <div class="container">
        <div class="row my-4">
            <div class="col-8"> <a href="/add-data" type="button" class="btn btn-success">Tambah +</a></div>
            <div class="col-4 d-flex justify-content-end">
                <form action="/data" method="GET" class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" name="search"
                        aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Data</th>
                        <th scope="col">Code Data</th>
                        <th scope="col">File Data</th>
                        <th scope="col">Created</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $item)
                        <tr>
                            <th scope="row" class="align-middle">{{ $index + $data->firstItem() }}</th>
                            <td class="align-middle">{{ $item->nama_data }}</td>
                            <td class="align-middle">{{ $item->data_code }}</td>
                            <td class="align-middle">
                                <img src="{{ asset('file-data/' . $item->file) }}" width="40px" />
                            </td>
                            <td class="align-middle">{{ $item->created_at->diffforhumans() }}</td>
                            <td>
                                <a href="/edit-data/{{ $item->id }}" type="button" class="btn btn-warning">Edit</a>
                                <a type="button" class="btn btn-danger delete" data-id="{{ $item->id }}"
                                    data-name="{{ $item->nama_data }}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links() }}
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

<script>
    $('.delete').click(function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        swal({
                title: "Apakah anda yakin??",
                text: "Kamu akan menghapus data file dengan nama " + name + "",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/delete/ " + id + ""
                    swal("File dengan nama  berhasil dihapus ", {
                        icon: "success",
                    });
                } else {
                    swal("Data anda tidak jadi dihapus!");
                }
            });
    });
</script>
<script>
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}")
</script>
@endif


</html>
