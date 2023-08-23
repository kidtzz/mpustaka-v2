<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h2>{{$title}}</h2>
        <div class="d-flex flex-row-reverse"><button class="btn btn-sm btn-pill btn-outline-primary font-weight-bolder" id="createNewBook"><i class="fas fa-plus"></i>add data </button></div>
      </div>
      <div class="card-body">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table" id="tableBuku">
              <thead class="font-weight-bold text-center">
                <tr>
                  {{-- <th>No.</th> --}}
                  <th>Kode Buku</th>
                  <th>Judul</th>
                  <th>Pengarang</th>
                  <th>Tahun Terbit</th>
                  <th>Jumlah Halaman</th>
                  <th style="width:90px;">Action</th>
                </tr>
              </thead>
              <tbody class="text-center">
                {{-- @foreach ($bukus as $r_bukus)
                <tr>
                  <td>{{$r_bukus->kode_buku}}</td>
                <td>{{$r_bukus->judul}}</td>
                <td>{{$r_bukus->pengarang}}</td>
                <td>{{$r_bukus->tahunTerbit}}</td>
                <td>{{$r_bukus->jmlHalaman}}</td>
                <td>
                  <div class="btn btn-success editBuku" data-id="{{$r_bukus->id}}">Edit</div>
                  <div class="btn btn-danger deleteBuku" data-id="{{$r_bukus->id}}">Delete</div>
                </td>
                </tr>
                @endforeach --}}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal-->
<div class="modal fade" id="modal-buku" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="exampleModalLabel">This Buku</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i aria-hidden="true" class="ki ki-close"></i>
        </button>
      </div>
      <div class="modal-body">
        <form id="formBuku" name=formBuku" action="POST " enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <div class="row">
              <div class="col-lg-6 col-md-6">
                <input type="text" name="kode_buku" class="form-control" id="kode_buku" placeholder="Kode Buku" readonly>
                <br>

                <div class="input_sih">
                  <input type="text" name="judul" class="form-control" id="judul" placeholder="Judul">
                  <div id="error_msg_judul">
                  </div>
                  <br>
                </div>

                <!-- <input type="text" name="deskripsi" class="form-control" id="deskripsi" placeholder="Deskripsi"> -->

                <textarea type="text" name="deskripsi" class="form-control" id="summernote"></textarea>
                <br>

                <input type="text" name="pengarang" class="form-control" id="pengarang" placeholder="Pengarang">
                <br>

              </div>
              <div class="col-lg-6 col-md-6">

                <input type="text" name="penerbit" class="form-control" id="penerbit" placeholder="Penerbit">
                <br>

                <input type="date" name="tahunTerbit" class="form-control" id="tahunTerbit" placeholder="Tahun Terbit">
                <br>

                <input type="number" name="jmlhHalaman" class="form-control" id="jmlhHalaman" placeholder="jumlah Halaman">
                <br>

                <div class="img-thumbnail img-fluid" id="gambarShow">

                </div>

                <div class="input_sih">
                  <input type="file" name="gambar" class="form-control" id="gambar" placeholder="gambar">
                  <div id="error_msg_gambar"></div>
                  <br>
                </div>
              </div>
            </div>

            <input type="hidden" name="buku_id" id="buku_id" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary font-weight-bold" id="saveBtn">Save changes</button>
          </div>
        </form>
      </div>


    </div>
  </div>
</div>


@push('scripts')
<script>
  $('document').ready(function() {
    toastr.options = {
      "progressBar": true,
      "positionClass": "toast-top-right",
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "3000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }

    // function swal_success() {
    //   Swal.fire({
    //     position: 'top-end',
    //     icon: 'success',
    //     title: 'Your work has been saved',
    //     showConfirmButton: false,
    //     timer: 1000
    //   })
    // }

    // error alert
    function swal_error() {
      toastr.error('Something goes wrong !', 'Error !');
    }

    //table show serverside
    var table = $('#tableBuku').DataTable({
      processing: false,
      serverSide: true,
      ordering: false,
      dom: 'Bfrtip',
      buttons: [
        'copy', 'excel', 'pdf'
      ],
      ajax: "{{ route('bukus.index') }}",
      columns: [{
          data: 'kode_buku',
          name: 'kode_buku'
        },
        {
          data: 'judul',
          name: 'judul'
        },
        {
          data: 'pengarang',
          name: 'pengarang'
        },
        {
          data: 'tahunTerbit',
          name: 'tahunTerbit'
        },
        {
          data: 'jmlhHalaman',
          name: 'jmlhHalaman'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        },
      ]
    });

    // csrf token
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    //show initialize btn add
    $('#createNewBook').click(function() {
      $('#saveBtn').val("create buku");
      $('#buku_id').val('');
      $('#formBuku').trigger("reset");
      $('#modal-buku').modal('show');
    });

    // initialize btn save
    $('#formBuku').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        type: 'POST',
        url: "{{ route('bukus.store') }}",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
          $('#formBuku').trigger("reset");
          $('#modal-buku').modal('hide');
          toastr.success('Data Berhasil Disimpan', 'Success !');
          table.draw();
        },
        error: function(xhr, data) {
          if (xhr.responseJSON) {
            $('#error_msg_judul').html('');
            $('#error_msg_judul').append('<div class="text-danger">' + xhr.responseJSON.errors['judul'] + '</div');

            $('#error_msg_gambar').html('');
            $('#error_msg_gambar').append('<div class="text-danger">' + xhr.responseJSON.errors['gambar'] + '</div');

          } else {
            swal_error()
          }
          $('#saveBtn').html('Save Changes');
        },
      });
    });

    // initialize btn edit
    $('body').on('click', '.editBuku', function() {
      var buku_id = $(this).data('id');
      $.get("{{route('bukus.index')}}" + '/' + buku_id + '/edit', function(data) {
        $('#saveBtn').val("edit-buku");
        $('#modal-buku').modal('show');
        $('#buku_id').val(data.id);
        $('#kode_buku').val(data.kode_buku);
        $('#judul').val(data.judul);
        $('#deskripsi').val(data.deskripsi);
        $('#pengarang').val(data.pengarang);
        $('#penerbit').val(data.penerbit);
        $('#tahunTerbit').val(data.tahunTerbit);
        $('#gambar').val(data.gambar);
        // $('#gambarShow').attr('src', data.gambar);
        // $('#gambarShow').attr("alt", data.gambar);
        $('#jmlhHalaman').val(data.jmlhHalaman);
        $('#gambarShow').append('<p class="text-danger">' + data.gambar + '</p>')
      })
    });

    // <
    // img width = " 250"
    // height = "200"
    // alt = "img"


    // initialize btn delete
    $('body').on('click', '.deleteBuku', function() {
      var buku_id = $(this).data("id");
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "DELETE",
            url: "{{route('bukus.store')}}" + '/' + buku_id,
            success: function(data) {
              toastr.error('Data Berhasil Delete', 'Success')
              table.draw();
            },
            error: function(data) {
              swal_error();
            }

          });
        }
      })
    });

  });
</script>
@endpush