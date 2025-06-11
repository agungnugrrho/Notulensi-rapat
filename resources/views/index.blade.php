<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Notulensi Rapat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="icon1.css">

    {{-- css icon info --}}
    <style>
        .custom-swal-icon {
            width: 50px !important;
            /* Lebar ikon lebih kecil */
            height: 50px !important;
            /* Tinggi ikon lebih kecil */
        }

        .custom-swal-popup {
            padding: 10px !important;
            /* Kurangi padding agar tampilan lebih compact */
        }
    </style>
    {{-- batas css --}}

</head>

<body style="font-family: Rockwell, Georgia, Serif;">

    {{-- form index --}}
    <div class="card mt-5 mx-5">
        <div class="card-header bg-primary text-white fs-4">
            Data Notulensi Rapat
        </div>
        <div class="card-body">
            <div class="container py-3">
                <div class="col">
                    <div class="text-end">
                        <a href="/frame1">
                            <button type="button" class="btn btn-outline-info">
                                <i class="bi bi-plus-square fs-6"></i> Rapat Baru
                            </button>
                        </a>
                    </div>
                </div>
                <table class="table table-bordered mt-4 text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Tempat</th>
                            <th>Pimpinan</th>
                            <th>Agenda</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($notulens->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data</td>
                            </tr>
                        @else
                            @foreach ($notulens as $notulen)
                                <tr>
                                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                    <td class="text-center align-middle">{{ $notulen->place }}</td>
                                    <td class="text-center align-middle">{{ $notulen->chairman }}</td>
                                    <td class="text-center align-middle">{{ $notulen->agenda }}</td>
                                    <td>
                                        <a href="{{ route('notulen.edit', $notulen->id) }}"
                                            class="btn btn-sm btn-primary" title="Edit">
                                            <i class="bi bi-pencil-square fs-5"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop" onclick="loadNotulen({{ $notulen->id }})"
                                            title="Detail">
                                            <i class="bi bi-info-circle-fill fs-5"></i>
                                        </a>
                                        <a href="{{ route('absen.index', $notulen->id) }}"
                                            class="btn btn-sm btn-primary" title="Absen">
                                            <i class="bi bi-card-checklist fs-5"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- batas form index --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- deskripsi --}}
    <script>
        function loadNotulen(id) {
            fetch('/notulen/' + id)
                .then(response => response.json())
                .then(data => {
                    let dateObj = new Date(data.dateInput);
                    let timeObj = new Date("1970-01-01T" + data.timeInput);

                    let formattedDate = dateObj.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    });

                    let formattedTime = timeObj.toLocaleTimeString('id-ID', {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false
                    });

                    // Menampilkan modal SweetAlert2 dengan data rapat
                    Swal.fire({
                        title: "<strong>Detail Rapat</strong>",
                        html: `
            <table class="table table-borderless text-start">
                <tr><td><b>Waktu</b></td>
                <td>:</td>
                <td>${formattedDate} ${formattedTime} WIB</td></tr>
                <tr><td><b>Notulis</b></td>
                <td>:</td>
                <td>${data.notulen}</td></tr>
                <tr><td><b>Keterangan</b></td>
                <td>:</td>
                <td>${data.keterangan}</td></tr>
            </table>
            <table class="table table-bordered mt-4 text-center">
            <thead class="table-primary">
                <tr>
                    <th style="width: 30%;">Pembahasan</th>
                    <th style="width: 30%;">Keputusan</th>
                </tr>
            </thead>
            <tbody class="table-secondary">
                <tr>
                <td style="width: 30%;">${data.pembahasan}</td>
                <td style="width: 30%;">${data.keputusan}</td>
                </tr>
            </tbody>
            </table>
        `,
                        icon: "info",
                        width: '1000px',
                        height: '1200px',
                        showCloseButton: true,
                        focusConfirm: false,
                        showConfirmButton: false,
                        allowOutsideClick: false, // Klik di luar tidak akan menutup modal
                        allowEscapeKey: false,
                        customClass: {
                            popup: 'custom-swal-popup',
                            icon: 'custom-swal-icon' // Tambahkan kelas khusus ke ikon
                        }

                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: "Terjadi Kesalahan",
                        text: "Gagal mengambil data notulen.",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                });
        }
    </script>
    {{-- batas deskripsi --}}

    {{-- notifikasi sukses --}}
    <script>
        // Tampilkan notifikasi sukses pada halaman index setelah berhasil simpan
        @if (session('message'))
            Swal.fire({
                title: "Sukses!",
                text: "{{ session('message') }}",
                icon: "success",
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    </script>
    {{-- batas notifikasi --}}

</body>

</html>




<!-- Modal -->
{{-- <div class="modal fade modal-lg" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">DETAIL RAPAT</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless">
                        <tr>
                            <td width="150">Waktu</td>
                            <td width="20">:</td>
                            <td id="modalWaktu">{{ $notulen->timeinput }}</td>
                        </tr>
                        <tr>
                            <td>Notulis</td>
                            <td>:</td>
                            <td id="modalNotulis">{{ $notulen->dateinput }}</td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td id="modalKeterangan"></td>
                        </tr>
                    </table>

                    <table class="table table-bordered mt-4 text-center">
                        <thead class="table-primary">
                            <tr>
                                <th>Pembahasan</th>
                                <th>Keputusan</th>
                            </tr>
                        </thead>
                        <tbody class="table-secondary">
                            <tr>
                                <td class="text-center align-middle" id="modalPembahasan"></td>
                                <td class="text-center align-middle" id="modalKeputusan"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}

{{-- <script>
        function loadNotulen(id) {
        fetch('/notulen/' + id)
        .then(response => response.json())
        .then(data => {
        let dateObj = new Date(data.dateInput);
        let timeObj = new Date("1970-01-01T" + data.timeInput);

        let formattedDate = dateObj.toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        });

        let formattedTime = timeObj.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        });

        document.getElementById('modalWaktu').innerText = ${formattedDate} ${formattedTime} WIB;
        document.getElementById('modalNotulis').innerText = data.notulen;
        document.getElementById('modalKeterangan').innerText = data.keterangan;
        document.getElementById('modalPembahasan').innerText = data.pembahasan;
        document.getElementById('modalKeputusan').innerText = data.keputusan;
        })
        .catch(error => console.error('Error:', error));
    }
        </script> --}}

{{-- button icon --}}
{{-- <td>
            a href="{{ route('notulen.edit', $notulen->id) }}">
            <i class="bi bi-pencil-square fs-3" style="margin: 0.5rem; color: #0d6efd"></i>
            </a>
            <a href=""  onclick="loadNotulen({{ $notulen->id }})">
            <i class="bi bi-info-circle-fill fs-3" style="color: #0d6efd;"></i>
            </a>
            a href="{{ route('absen.index', $notulen->id) }}">
            <i class="bi bi-card-checklist fs-3" style="margin: 0.5rem; color: #0d6efd"></i>
            </a>
            </td> --}}
{{-- batas button icon --}}
