{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kehadiran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body style="font-family: rockwell">
    <div class="container py-5 mx-auto">
        <div class="row align-items-start mt-4">
            <form id="form-absen" action="{{ route('absen.save', $notulen->id) }}" method="post"> --}}
            {{-- <form id="form-absen" action="{{ route('absen.save') }}" method="post">
            @csrf
            <div class="col">
                <label for="nama" class="form-label">Nama Peserta</label>
                <input type="text" id="nama" class="form-control" placeholder="Nama Peserta" />
            </div>
            <div class="col">
                <label for="jabatan" class="form-label">Jabatan/Posisi</label>
                <input type="text" id="jabatan" class="form-control" placeholder="Jabatan/Posisi" />
            </div>
            {{-- <div class="col">
                <label class="form-label">Kehadiran</label>
                <input type="file" class="form-control" id="attendance" />
            </div> --}}
        {{-- </div> --}}
        {{-- <div class="row align-items-end mt-4"> --}}
        {{-- <div class="d-flex justify-content-end align-items-end mt-4 gap-2">
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#kembali">Kembali</button> --}}
            {{-- <button type="submit" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#simpan"> <i class="bi bi-plus-circle"></i> Simpan</button> --}}
            {{-- <button type="submit" class="btn btn-outline-info"> <i class="bi bi-plus-circle"></i> Simpan</button>
        </div>
    </form>
            <table class="table table-bordered mt-4 text-center" style="margin-bottom: 10%">
                <thead class="table-primary">
                    <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Jabatan/Posisi Kerja</th>
                    <th>Paraf</th>
                    </tr>
                </thead>
                <tbody class="table-secondary"> --}}
                    {{-- @if ( $notulenDetail->isEmpty() )
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada absensi , silahkan isi absensi !</td>
                    </tr>
                    @endif --}}
                    {{-- @foreach ( $notulenDetail as $detail )
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $detail->nama }}</td>
                        <td>{{ $detail->jabatan }}</td>
                        <td>{{ $detail->tanda_tangan }}</td>
                    </tr>
                    @endforeach --}}
                {{-- </tbody>
            </table>




    {{-- </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/script.js"></script>

</body>
</html>

    {{-- <script>
        document.getElementById('form-absen').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah reload halaman

            let formData = new FormData(this);
            let url = this.action; // Ambil URL dari form action

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Tambahkan data ke tabel tanpa reload
                    let tableBody = document.querySelector('tbody.table-secondary');
                    let newRow = document.createElement('tr');

                    newRow.innerHTML = `
                        <td>${data.detail.no}</td>
                        <td>${data.detail.nama}</td>
                        <td><img src="${data.detail.tanda_tangan}" alt="Tanda Tangan" width="50"></td>
                    `;

                    tableBody.appendChild(newRow);

                    // Reset form setelah submit
                    document.getElementById('form-absen').reset();

                    // Tampilkan modal sukses
                    let modal = new bootstrap.Modal(document.getElementById('simpan'));
                    modal.show();
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>  --}}

    {{-- <footer class="d-flex align-items-center mt-4">
        <a href="/absen/save" class="btn btn-outline-info">
            <i class="bi bi-chevron-double-left"></i> Halaman Sebelumnya
        </a>
        <span style="margin-left: 31%">3/3</span>
    </footer> --}}


{{-- MODAL SIMPAN --}}
{{-- <div class="modal fade" id="simpan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="simpanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-sm">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center" style="min-height: 50px; padding: 8px 15px;">
                <h1 class="modal-title fs-5" id="simpanLabel">SUKSES</h1>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style="color: #dc3545"><i class="bi bi-x-square fs-5" style="text-shadow: 1px 1px 2px black;"></i></button>
            </div>
            <div class="modal-body">
                DATA BERHASIL DISIMPAN !
            </div>
            <div class="modal-footer">
                <a href="{{ route('absen.save') }}"> <button type="button" class="btn btn-outline-primary" style="--bs-btn-font-size: .60rem;">OK, MAKASIH MIN !</button></a>
            </div>
        </div>
    </div>
</div> --}}
{{-- MODAL SIMPAN --}}

{{-- MODAL KEMBALI --}}
{{-- <div class="modal fade" id="kembali" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="kembaliLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header d-flex justify-content-between align-items-center">
        <h1 class="modal-title fs-5" id="kembaliLabel">PERINGATAN !</h1>
        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style="color: #dc3545"><i class="bi bi-x-square fs-5" style="text-shadow: 1px 1px 2px black;"></i></button>
    </div>
    <div class="modal-body">
        APAKAH ANDA INGIN KEMBALI? DATA TIDAK AKAN DISIMPAN.
    </div>
    <div class="modal-footer">
        <a href="/index"><button type="button" class="btn btn-outline-danger">Tetap Kembali</button></a>
    </div>
    </div>
</div>
</div>
{{-- MODAL KEMBALI

--}}
