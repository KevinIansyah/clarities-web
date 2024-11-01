@extends('dashboard.layouts.main')

@section('main')
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 mb-4 mb-xl-0">
            <div
              class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center w-100">
              <div>
                <h3 class="font-weight-bold">Data Struktur Organisasi</h3>
                <h6 class="font-weight-normal mb-0">Kelola data Struktur Organisasi Anda di sini!</h6>
              </div>

              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Struktur Organisasi</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <form action="{{ route('dashboard.pages.struktur-organisasi.store') }}" method="POST" class="form-sample"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="file" class="filepond image" name="image" required>
                      </div>
                    </div>
                  </div>
                  @canany(['tambah strukturorganisasi', 'edit strukturorganisasi'])
                    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                  @endcanany
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    FilePond.create(
      document.querySelector('.image'), {
        server: {
          load: (source, load, error, progress, abort, headers) => {
            const myRequest = new Request(source);
            fetch(myRequest).then((res) => {
              return res.blob();
            }).then(load);
          },
          process: "/dashboard/upload-image",
          revert: "/dashboard/cancel-image",
          @can('hapus strukturorganisasi')
            remove: (source, load, error) => {
              fetch('/dashboard/pages/struktur-organisasi/remove-image', {
                  method: 'DELETE',
                  headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Content-Type': 'application/json'
                  },
                  body: JSON.stringify({
                    source: source
                  })
                })
                .then(response => response.json())
                .then(data => {
                  if (data.success) {
                    load();
                  } else {
                    error('An error occurred while removing the file.');
                  }
                })
                .catch(err => {
                  error(err.message);
                });
            },
          @endcan
          headers: {
            "X-CSRF-TOKEN": CSRF_TOKEN,
          },
        },
        allowMultiple: false,
        allowReorder: false,
        allowFileSizeValidation: true,
        allowFileTypeValidation: true,
        maxFiles: 1,
        maxFileSize: '2MB',
        labelMaxFileSize: 'Maximum file size is {filesize}',
        acceptedFileTypes: ['image/*'],
        labelFileTypeNotAllowed: 'File of invalid type. Please upload PNG, JPG, or JPEG files only.',
        files: [
          @if ($strukturOrganisasi && $strukturOrganisasi->image)
            {
              source: "{{ asset('storage/filepond-image/' . $strukturOrganisasi->image) }}",
              options: {
                type: 'local'
              }
            }
          @endif
        ],
      }
    );
  </script>
@endpush
