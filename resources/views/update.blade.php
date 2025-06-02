<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" >
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

</head>
<body style="font-family: rockwell;">

    {{-- form update --}}
    <div class="container py-5 mx-auto">
        <div class="text-align-left">
            <form id="farmForm" action="{{ route('notulen.update',$notulen->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row align-items-start">
                    <div class="col-3">
                        <label for="dateInput" class="form-label d-flex align-items-center">Tanggal*</label>
                        <input type="date" class="form-control" id="dateInput" name="dateInput" placeholder="tanggal" value="{{$notulen->dateInput}}">
                    </div>
                    <div class="col-3">
                        <label for="timeInput" class="form-label">Waktu</label>
                        <input type="time" class="form-control" id="timeInput" name="timeInput" placeholder="waktu" value="{{$notulen->timeInput}}">
                    </div>
                </div>
                <div class="mt-4">
                    <div class="row align-items-center">
                        <div class="col">
                            <label for="place" class="form-label">Tempat</label>
                            <input type="text" class="form-control" id="place" name="place" placeholder="ketik nama tempat" value="{{$notulen->place}}">
                        </div>
                        <div class="col">
                            <label for="chairman" class="form-label">Pimpinan Musyawarah</label>
                            <input type="text" class="form-control" id="chairman" name="chairman" placeholder="ketik nama pimpinan musyawarah" value="{{$notulen->chairman}}">
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="row align-items-center">
                        <div class="col">
                            <label for="notulen" class="form-label">Notulis</label>
                            <input type="text" class="form-control" id="notulen" name="notulen" placeholder="ketik nama notulis" value="{{$notulen->notulen}}">
                        </div>
                        <div class="col">
                            <label for="agenda" class="form-label">Agenda Rapat</label>
                            <input type="text" class="form-control" id="agenda" name="agenda" placeholder="ketik agenda" value="{{$notulen->agenda}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-4">
                    <label for="pembahasan" class="form-label">Pembahasan</label>
                    <textarea type="text" class="form-control" id="pembahasan" name="pembahasan" rows="7">{{$notulen->pembahasan}}</textarea>
                </div>

                <div class="row align-items-end mt-4">
                    <div class="col-6">
                        <label for="keputusan" class="form-label">Keputusan</label>
                        <input type="text" class="form-control" id="keputusan" name="keputusan"  placeholder="ketik keputusan" value="{{$notulen->keputusan}}" >
                    </div>
                    <div class="col">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <select class="form-select" name="keterangan" id="keterangan">
                            <option value="" disabled selected>Pilih keterangan</option>
                            <option value="Eksekusi" {{ $notulen->keterangan == 'Eksekusi' ? 'selected' : '' }}>Eksekusi</option>
                            <option value="Eskalasi" {{ $notulen->keterangan == 'Eskalasi' ? 'selected' : '' }}>Eskalasi</option>
                        </select>
                    </div>
                    <div class="col">
                <div class="text-end">
                        <button type="button" class="btn btn-outline-danger" id="backButton">
                            <i class="bi bi-arrow-left-circle"></i> Kembali
                        </button>
                    <button type="submit" class="btn btn-outline-primary ms-2 w-12" id="btn-simpan">
                        <i class="bi bi-plus-circle"></i> Ubah</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    {{-- batas form update --}}

{{-- SCRIPT GROUP --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


{{-- button kembali konfirmasi --}}
<script>
    document.getElementById("backButton").addEventListener("click", function() {
        Swal.fire({
            title: "Apakah Anda yakin ingin kembali?",
            text: "Data Tidak Akan Disimpan!",
            icon: "error",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Kembali",
            cancelButtonText: "Batal",
            allowOutsideClick: false, // Klik di luar tidak akan menutup modal
            allowEscapeKey: false
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('notulen.index') }}";
            }
        });
    });
</script>
{{-- bates button kembali konfirmasi --}}

{{-- update data konfirmasi --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("farmForm");
    const btnSimpan = document.getElementById("btn-simpan");

      // Data input yang wajib diisi
    const requiredInputs = [
        { id: "dateInput", name: "Tanggal" },
        { id: "timeInput", name: "Waktu" },
        { id: "place", name: "Tempat" },
        { id: "chairman", name: "Pimpinan Musyawarah" },
        { id: "agenda", name: "Agenda Rapat" },
        { id: "notulen", name: "Notulis" },
        { id: "pembahasan", name: "Pembahasan" },
        { id: "keputusan", name: "Keputusan" },
        { id: "keterangan", name: "Keterangan" },
    ];

      // Saat tombol "Simpan" ditekan
    btnSimpan.addEventListener("click", function (event) {
        event.preventDefault();
        let isValid = true;
        let errorMessages = [];

        // Hapus pesan error sebelumnya
        document.querySelectorAll(".error-message").forEach(e => e.remove());

        // Cek input wajib
        requiredInputs.forEach(input => {
        let element = document.getElementById(input.id);
        if (element.value.trim() === "") {
            isValid = false;
            errorMessages.push(`${input.name} tidak boleh kosong!`);
            showError(element, `${input.name} harus diisi!`);
        }
        });

        // Jika ada error, tampilkan SweetAlert2 dengan daftar error
        if (!isValid) {
        Swal.fire({
            title: "Terjadi Kesalahan!",
            html: `<ul style="text-align: left;">${errorMessages.map(msg => `<li>${msg}</li>`).join('')}</ul>`,
            icon: "error",
            confirmButtonText: "OK"
        });
        return;
        }

        // Jika valid, tampilkan konfirmasi sebelum menyimpan
        Swal.fire({
            title: "Konfirmasi Update",
            text: "Apakah data sudah benar dan ingin diubah?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Ubah",
            cancelButtonText: "Batal",
            allowOutsideClick: false, // Klik di luar tidak akan menutup modal
            allowEscapeKey: false
        }).then((result) => {
        if (result.isConfirmed) {
              form.submit(); // Submit form setelah konfirmasi
            }
        });
        });


      // Hapus pesan error saat user mengetik atau mengubah input
    requiredInputs.forEach(input => {
        let element = document.getElementById(input.id);
        element.addEventListener("input", function () {
        removeError(element);
        });
        element.addEventListener("change", function () {
        removeError(element);
        });
    });

      // Fungsi menampilkan error di bawah input
    function showError(inputElement, message) {
        let errorSpan = document.createElement("span");
        errorSpan.classList.add("error-message");
        errorSpan.style.color = "red";
        errorSpan.style.fontSize = "12px";
        errorSpan.textContent = message;
        inputElement.insertAdjacentElement("afterend", errorSpan);
    }

      // Fungsi menghapus pesan error saat input berubah
    function removeError(inputElement) {
        let errorSpan = inputElement.nextElementSibling;
        if (errorSpan && errorSpan.classList.contains("error-message")) {
        errorSpan.remove();
        }
    }
    });
</script>
{{-- batas update data konfirmasi --}}

{{-- INPUT WAKTU DAN TANGGAL SEBELUM NOW --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dateInput = document.getElementById("dateInput");
        const timeInput = document.getElementById("timeInput");


        const today = new Date();
        const formattedDate = today.toISOString().split("T")[0];
        dateInput.setAttribute("min", formattedDate);

        function updateTimeMin() {
            const selectedDate = dateInput.value;
            const currentTime = today.toTimeString().slice(0, 5);

            if (selectedDate === formattedDate) {
                timeInput.setAttribute("min", currentTime);
            } else {
                timeInput.removeAttribute("min");
            }
        }

        dateInput.addEventListener("change", updateTimeMin);
    });
</script>

</body>
</html>

{{-- DATA/FIELD KOSONG --}}
{{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("form-notulen");
    const btnSimpan = document.getElementById("btn-simpan");
    const btnConfirmSave = document.getElementById("confirmSave");
    // Data kosong
    const requiredInputs = [
        document.getElementById("dateInput"),
        document.getElementById("timeInput"),
        document.getElementById("place"),
        document.getElementById("chairman"),
        document.getElementById("agenda"),
        document.getElementById("notulen")
    ];

    // Saat tombol "Simpan" ditekan
    btnSimpan.addEventListener("click", function (event) {
        event.preventDefault();
        let isValid = true;

    // Validasi tiap input wajib
    requiredInputs.forEach(input => {
        if (input.value.trim() === "") {
            isValid = false;
            showError(input, "data tidak boleh kosong!");
        }
        });

    // Jika semua valid, tampilkan modal konfirmasi
    if (isValid) {
        let modalKonfirmasi = new bootstrap.Modal(document.getElementById("modalKonfirmasi"));
        modalKonfirmasi.show();
        }
    });

    // Jika user mengonfirmasi, submit form
    btnConfirmSave.addEventListener("click", function () {
        form.submit();
    });

    // Hapus pesan error saat user mengetik atau mengubah input
    requiredInputs.forEach(input => {
        input.addEventListener("input", function () {
        removeError(input);
        });
        input.addEventListener("change", function () {
        removeError(input);
        });
    });

    function showError(inputElement, message) {
        let errorSpan = document.createElement("span");
        errorSpan.classList.add("error-message");
        errorSpan.style.color = "red";
        errorSpan.style.fontSize = "12px";
        errorSpan.textContent = message;
        inputElement.insertAdjacentElement("afterend", errorSpan);
    }

    function removeError(inputElement) {
        let errorSpan = inputElement.nextElementSibling;
        if (errorSpan && errorSpan.classList.contains("error-message")) {
        errorSpan.remove();
        }
    }
    });
</script> --}}

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
</div> --}}
{{-- MODAL KEMBALI --}}

{{-- MODAL UBAH --}}
{{-- <div class="modal fade" id="modalKonfirmasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ubahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-sm">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center" style="min-height: 50px; padding: 8px 15px;">
                <h1 class="modal-title fs-5" id="modalKonfirmasi" type="submit">SUKSES</h1>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style="color: #dc3545"><i class="bi bi-x-square fs-5" style="text-shadow: 1px 1px 2px black;"></i></button> --}}
            {{-- {{-- </div> --}}
            {{-- <div class="modal-body">
                DATA BERHASIL DIPERBAHARUI !
            </div>
            <div class="modal-footer">
                <a href="/index"><button type="button" class="btn btn-outline-primary" style="--bs-btn-font-size: .60rem;"id="confirmSave" >OK, MAKASIH MIN !</button></a>
            </div>
        </div>
    </div> --}}
    {{-- </div>
    {{-- MODAL UBAH --}}

<!-- MODAL KONFIRMASI SIMPAN -->
{{-- <div class="modal fade" id="modalKonfirmasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalKonfirmasiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-sm">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="modalKonfirmasiLabel">Konfirmasi Simpan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        Apakah data sudah benar dan ingin disimpan?
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="confirmSave">Simpan</button>
        </div>
    </div>
    </div>
</div> --}}
<!-- END MODAL KONFIRMASI SIMPAN -->
