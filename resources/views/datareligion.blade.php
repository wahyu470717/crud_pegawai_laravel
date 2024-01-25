@extends('layout/admin')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endpush

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Religion</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Data Religion</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    {{-- //table data pegawai// --}}
    <div class="container mb-5">
      <a href="/tambahagama"  class="btn btn-success mb-2">tambah +</a>
      {{-- {{ Session::get('halaman_url') }} --}}

      <div class="row mt-4">
        {{-- @if ($message = Session::get('success'))
          <div class="alert alert-success">
            {{ $message }}
        @endif --}}
          </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            {{-- @php
              $no = 1;
            @endphp --}}
            @foreach ($data as $index => $row)
              <tr>
                <th scope="row">{{ $index + $data->firstItem() }}</th>
                <td>{{$row->nama}}</td>
                <td>{{$row->created_at->format('D-M-Y')}}</td>
                <td>
                  <a href="/tampilkandata/{{$row->id}}" class="btn btn-warning">Edit</a>
                  <a 
                    href="#" 
                    class="btn btn-danger delete" 
                    data-id="{{ $row->id }}"
                    data-nama="{{ $row->nama }}"
                  >
                    Hapus
                </a>
                </td>
              </tr> 
            @endforeach
            
          </tbody>
        </table>
        {{-- paginataion --}}
        {{ $data->links() }}
      </div>
    </div>

  </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </body>

@endsection
{{-- 
@push('scripts')
<script>
  $('.delete').click( function() {
    var pegawaiid = $(this).attr('data-id');
    var nama = $(this).attr('data-nama');

    const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
    confirmButton: "btn btn-success",
    cancelButton: "btn btn-danger"
    },
    buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
      title: "Yakin ?",
      text: "Kamu akan Menghapus Data Pegawai Dengan Nama "+nama+"",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "delete/"+pegawaiid+""
        swalWithBootstrapButtons.fire({
          title: "Terhapus!",
          text: "Data Pegawai Berhasil Di Hapus.",
          icon: "success"
        });
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire({
          title: "Batal",
          text: "Data Pegawai Batal Terhapus",
          icon: "error"
        });
      }
    });
  });

</script>
<script>
  @if (Session::has('success'))
    toastr.success("{{ Session::get('success') }}");
  @endif
</script>
@endpush --}}