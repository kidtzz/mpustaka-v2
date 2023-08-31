<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h2>{{$title}}</h2>
        <div class="d-flex flex-row-reverse"><button class="btn btn-sm btn-pill btn-outline-primary font-weight-bolder" id="create_new_pinjam"><i class="fas fa-plus"></i>add pinjam </button></div>
      </div>
      <div class="card-body">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table" id="table_pinjam">
              <thead class="font-weight-bold text-center">
                <tr>
                  {{-- <th>No.</th> --}}
                  <th>no_pinjam</th>
                  <th>nama_pinjam</th>
                  <th>tanggal_pinjam</th>
                  <th>tanggal_kembali</th>
                  <th>submit_by</th>
                  <th style="width:90px;">Action</th>
                </tr>
              </thead>
              <tbody class="text-center">
                {{-- @foreach ($q_pinjam as $r_pinjam)
                <tr>
                  <td>{{$r_pinjam->no_pinjam}}</td>
                <td>{{$r_pinjam->nama_pinjam}}</td>
                <td>{{$r_pinjam->tanggal_pinjam}}</td>
                <td>{{$r_pinjam->tanggal_kembali}}</td>
                <td>{{$r_pinjam->submit_by}}</td>
                <td>
                  <div class="btn btn-success edit_pinjam" data-id="{{$r_pinjam->id}}">Edit</div>
                  <div class="btn btn-danger delete_pinjam" data-id="{{$r_pinjam->id}}">Delete</div>
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
<div class="modal fade" id="modal-pinjam" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="exampleModalLabel">This Peminjaman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i aria-hidden="true" class="ki ki-close"></i>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_pinjam" name=form_pinjam" action="POST " enctype="multipart/form-data">
          @csrf
          <div class="form-group">

            <input type="text" name="no_pinjam" class="form-control" id="no_pinjam" placeholder="Kode Peminjam" readonly>
            <br>

            <input type="text" name="nama_pinjam" class="form-control" id="nama_pinjam" placeholder="nama_pinjam">
            <br>

            <input type="date" name="tanggal_pinjam" class="form-control" id="tanggal_pinjam" placeholder="tanggal_pinjam">
            <br>

            <input type="date" name="tanggal_kembali" class="form-control" id="tanggal_kembali" placeholder="tanggal_kembali">
            <br>

            <input type="text" name="submit_by" class="form-control" id="submit_by" placeholder="submit_by">
            <br>

            <input type="hidden" name="pinjam_id" id="pinjam_id" value="">
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

    // error alert
    function swal_error() {
      toastr.error('Something goes wrong !', 'Error !');
    }

    //table show serverside
    var table = $('#table_pinjam').DataTable({
      processing: false,
      serverSide: true,
      ordering: false,
      dom: 'Bfrtip',
      buttons: [
        'copy', 'excel', 'pdf'
      ],
      ajax: "{{ route('control_pinjam.index') }}",
      columns: [{
          data: 'no_pinjam',
          name: 'no_pinjam'
        },
        {
          data: 'nama_pinjam',
          name: 'nama_pinjam'
        },
        {
          data: 'tanggal_pinjam',
          name: 'tanggal_pinjam'
        },
        {
          data: 'tanggal_kembali',
          name: 'tanggal_kembali'
        },
        {
          data: 'submit_by',
          name: 'submit_by'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        },
      ]
    });

    $('#count_pinjam').html('<span class="label label-rounded label-primary"> ' +
      <?= $count_pinjam ?> + ' </span>')

    // csrf token
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    //show initialize btn add
    $('#create_new_pinjam').click(function() {
      $('#saveBtn').val("create peminjam");
      $('#pinjam_id').val('');
      $('#form_pinjam').trigger("reset");
      $('#modal-pinjam').modal('show');

    });

    // initialize btn save
    $('#form_pinjam').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        type: 'POST',
        url: "{{ route('control_pinjam.store') }}",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
          $('#form_pinjam').trigger("reset");
          $('#modal-pinjam').modal('hide');
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
    $('body').on('click', '.edit_pinjam', function() {
      var pinjam_id = $(this).data('id');
      $.get("{{route('control_pinjam.index')}}" + '/' + pinjam_id + '/edit', function(data) {
        $('#saveBtn').val("edit-pinjam");
        $('#modal-pinjam').modal('show');
        $('#pinjam_id').val(data.id);
        $('#no_pinjam').val(data.no_pinjam);
        $('#nama_pinjam').val(data.nama_pinjam);
        $('#tanggal_pinjam').val(data.tanggal_pinjam);
        $('#tanggal_kembali').val(data.tanggal_kembali);
        $('#submit_by').val(data.submit_by);
      })

    });

    // initialize btn delete
    $('body').on('click', '.delete_pinjam', function() {
      var pinjam_id = $(this).data("id");
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
            url: "{{route('control_pinjam.store')}}" + '/' + pinjam_id,
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