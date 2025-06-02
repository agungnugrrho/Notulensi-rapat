<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $notulen -> agenda }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

</head>

<body style="font-family: rockwell">
        <div class="container my-3">
            <div class="card mx-auto border-1" style="margin-top: 3%;">
                <div class="card-header bg-info">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title">
                                Absen Kegiatan {{  $notulen-> agenda }}
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table>
                        <tr>
                            <td width="150">Nama Kegiatan</td>
                            <td width="20">:</td>
                            <td>{{ $notulen -> agenda }}</td>
                        </tr>
                        <tr>
                            <td>Tempat</td>
                            <td>:</td>
                            <td>{{ $notulen -> place }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td>{{ \Carbon\Carbon::parse($notulen->dateInput)->translatedformat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td>Waktu</td>
                            <td>:</td>
                            <td>{{ date('H:i', strtotime($notulen -> timeInput )) }} WIB</td>
                        </tr>
                    </table>
                    <div>
                        <hr class="border-2 mt-4">
                    </div>
                    <div class="text-align-left mx-auto py-1" >
                        <form id="form-absen" action="{{ route('absen.store', request()->id) }}" method="post" enctype='multipart/form-data'>
                                @csrf
                                <div class="col">
                                    <label for="nama" class="form-label">Nama Peserta</label>
                                    <input type="text" id="nama" class="form-control" placeholder="Nama Peserta" name="nama">
                                </div>
                                <div class="col">
                                    <label for="jabatan" class="form-label">Jabatan/Posisi</label>
                                    <input type="text" id="jabatan" class="form-control" placeholder="Jabatan/Posisi" name="jabatan">
                                </div>
                                <div class="col" >
                                    <label class="form-label">Kehadiran</label>
                                    <div class="d-block form-control mb-1" style="height: 100px;">
                                        <canvas id="ttd-pad" class="ttd-pad " ></canvas>
                                    </div>
                                    <textarea name="pesan" class="d-none" name="tanda_tangan" id="tanda_tangan64" class="d-none"></textarea>
                                </div>
                                <div class="row align-items-end mt-1">
                                    <div class="d-flex justify-content-end align-items-end mt-1 gap-2">
                                        <button type="submit" class="btn btn-outline-info"  id="btn-simpan"> <i class="bi bi-plus-circle"></i> Simpan</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    {{-- </div> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/script.js"></script>
    <script src="{{ asset('js/signature.min.js') }}"></script>

    {{-- script input --}}
    <script>
        $(function () {
            let sig = $("#ttd-pad").parent().width();
            $("#ttd-pad").attr("width", sig).attr("height", 200);

            let ttdPad = new TtdPad(document.getElementById("ttd-pad"), {
                backgroundColor: "rgba(255, 255, 255, 0)",
                penColor: "rgb(0, 0, 0)",
            });

            // Saat tanda tangan selesai dibuat, simpan ke input hidden
            function saveSignature() {
                let signatureData = ttdPad.toDataURL("image/png");
                $("#tanda_tangan64").val(signatureData);
                console.log("Tanda tangan tersimpan (PNG):", signatureData);
            }

            $("canvas").on("mouseup touchend", function () {
                saveSignature(); // Simpan tanda tangan saat selesai digambar
            });

            // Tombol hapus tanda tangan
            $("#clear-tanda_tangan").on("click", function (e) {
                e.preventDefault();
                ttdPad.clear();
                $("#tanda_tangan64").val("");
                console.log("Tanda tangan dihapus!"); // Debugging
            });

            // Tombol submit form dengan validasi & SweetAlert
            $("#btn-simpan").on("click", function (event) {
                event.preventDefault(); // Mencegah submit otomatis

                saveSignature(); // Pastikan tanda tangan tersimpan sebelum validasi

                let nama = $("#nama").val().trim();
                let jabatan = $("#jabatan").val().trim();
                let tandaTangan = $("#tanda_tangan64").val().trim();

                // Hapus pesan error sebelumnya
                $(".error-message").remove();

                let isValid = true;

                // Validasi Nama
                if (nama === "") {
                    isValid = false;
                    showError("#nama", "Nama Peserta harus diisi!");
                }

                // Validasi Jabatan
                if (jabatan === "") {
                    isValid = false;
                    showError("#jabatan", "Jabatan/Posisi harus diisi!");
                }

                // Validasi Tanda Tangan
                if (tandaTangan === "") {
                    isValid = false;
                    showError("#ttd-pad", "Silakan tanda tangan terlebih dahulu!");
                }

                console.log("Tanda tangan yang dikirim:", tandaTangan); // Debugging

                // Jika valid, tampilkan konfirmasi SweetAlert
                if (isValid) {
                    saveSignature(); // Simpan ulang tanda tangan sebelum submit
                    console.log("Form disubmit dengan tanda tangan:", $("#tanda_tangan64").val()); // Debugging

                    Swal.fire({
                        title: "Berhasil!",
                        text: "Data berhasil disimpan.",
                        icon: "success",
                        timer: 2000, // Notif otomatis hilang setelah 2 detik
                        showConfirmButton: false // Hilangkan tombol "OK"
                    });

                    setTimeout(() => {
                        $("#form-absen").submit(); // Submit form otomatis
                    }, 2000); // Waktu tunggu sama dengan timer Swal
                }
            });

            function showError(selector, message) {
                let errorSpan = $("<span class='error-message' style='color:red; font-size:12px;'></span>").text(message);
                $(selector).after(errorSpan);
            }
        });
        </script>
    {{-- batas script input--}}

</body>
</html>

    {{-- MODAL KEMBALI --}}
    {{-- <div class="modal fade" id="kembali" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="kembaliLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header d-flex justify-content-between align-items-center">
            <h1 class="modal-title fs-5" id="kembaliLabel">PERINGATAN !</h1>
            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style="color: #dc3545"><i class="bi bi-x-square fs-5" style="text-shadow: 1px 1px 2px black;"></i></button>
        </div>
        <div class="modal-body">
            APAKAH ANDA INGIN KEMBALI? DATA BARU TIDAK AKAN DISIMPAN.
        </div>
        <div class="modal-footer">
            <a href="/index"><button type="button" class="btn btn-outline-danger">Tetap Kembali</button></a>
        </div>
        </div>
    </div>
    </div> --}}
    {{-- MODAL KEMBALI --}}

    {{-- MODAL SIMPAN --}}
    {{-- <form id="form-absen" action="{{ route('absen.store', request()->id) }}" method="post" enctype='multipart/form-data'>
    @csrf
    <div class="modal fade" id="simpan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="simpanLabel" aria-hidden="true">
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
                    <a href="{{ route('absen.index', $notulen->id) }}"><button type="button" class="btn btn-outline-primary" style="--bs-btn-font-size: .60rem;">OK, MAKASIH MIN !</button></a>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Modal Konfirmasi -->
    {{-- <div class="modal fade" id="modalKonfirmasi" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Konfirmasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menyimpan data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success" id="confirmSave">Ya, Simpan</button>
                    </div>
                </div>
            </div>
    </div> --}}

    {{-- FOOTER (GAKEPAKE) --}}
    {{-- <footer class="d-flex align-items-center mt-4">
        <a href="/frame2" class="btn btn-outline-info">
            <i class="bi bi-chevron-double-left"></i> Halaman Sebelumnya
        </a>
        <span style="margin-left: 31%">3/3</span>
    </footer> --}}
    {{-- // Konfirmasi sebelum kembali ke halaman utama --}}


        {{-- SweetAlert Kembali --}}
    {{-- <script>
    document.getElementById("backButton").addEventListener("click", function() {
        Swal.fire({
            title: "Apakah Anda yakin ingin kembali?",
            text: "Data Tidak Akan Disimpan!",
            icon: "error",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Kembali",
            cancelButtonText: "Batal"
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('absen.show') }}";
        }
    });
});
    </script> --}}
    {{-- batas SweetAlert Kembali --}}

        {{-- SCript Pilih File (udah diganti ttd/paraf) --}}
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function () {
            const inputFile = document.getElementById("attendance");
            inputFile.addEventListener("change", function () {
                if (this.files.length > 0) {
                    labelText.textContent = this.files[0].name;
                } else {
                    labelText.textContent = "Silahkan pilih file";
                }
            });
        });
    </script> --}}
    {{-- SCript Pilih File (udah diganti ttd/paraf) --}}

        {{-- <input type="file" class="form-control" id="attendance" placeholder="tanda-tangan" name="tanda_tangan"> --}}
        {{-- <button type="button" class="btn btn-outline-danger" id="backButton">
        <i class="bi bi-arrow-left-circle"></i> Kembali
        </button> --}}
        {{-- <button type="submit" class="btn btn-outline-info" id="attendance" > <i class="bi bi-plus-circle"></i> Simpan</button> --}}
