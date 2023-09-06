@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<link href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tabel Antrian (Poli : {{ $doctors->poly->nama }})</h6>
                </div>
                <div class="card-body px-5 py-3">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <table class="table table-striped my-4" id="myTable" style="max-width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="col-md">#</th>
                                        <th class="col-md-4">Nomer Antrian</th>
                                    </tr>
                                </thead>
                                <tbody id="table-content">
                                    @foreach ($doctors->poly->patient as $doctor)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $doctor->antrian }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>


                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card border rounded-2 shadow-lg p-3 mb-5 bg-body text-center">
                                <div class="border rounded-3">
                                    <h5 style="font-size: 2rem;">Antrian Sekarang</h5>
                                </div>

                                <div>
                                    <p class="badge badge-primary" style="font-size: 3rem; color: black;" id="nomor">
                                        {{ $doctors->poly->status ? $doctors->poly->patient[0]->antrian : '-' }}</p>
                                </div>
                            </div>
                            <button id="ambil-antrian" class="btn btn-succes my-3" @if ($doctors->poly->status)
                                style="display: none;" @endif>Ambil Antrian</button>
                            <button id="antrian-selanjutnya" class="btn btn-warning my-3" @if (!$doctors->poly->status
                                || count($doctors->poly->patient) < 2) style="display: none;" @endif>Antrian
                                    Selanjutnya</button>
                            <button id="hapus-antrian" class="btn btn-danger my-3" @if (!$doctors->poly->status)
                                style="display: none;" @endif>Hapus Antrian</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>
<script>
    var stat = {{ $doctors->poly->status }};
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
            var tbody = document.querySelector('#table-content');
            Echo.channel(`doctor-antrian`)
                .listen('DoctorAntrian', (e) => {
                    // console.log(e.data);
                    if ('{{ $doctors->poly->initial }}' === e.data[0] ? e.data[0].poly_initial : '-') {

                        if (tbody) {
                            // Remove all child nodes (rows) from the <tbody> element
                            while (tbody.firstChild) {
                                tbody.removeChild(tbody.firstChild);
                            }
                        }
                        // console.log(response.table);
                        // Create a new row and cells

                        var jum = 0;
                        if (e.data) {
                            e.data.forEach(function(antrian, index) {
                                var newRow = document.createElement("tr");
                                var cell1 = document.createElement("td");
                                var cell2 = document.createElement("td");

                                // Set the content for the new cells
                                cell1.textContent = index + 1;
                                cell2.textContent = antrian.antrian;

                                // Append the cells to the new row
                                newRow.appendChild(cell1);
                                newRow.appendChild(cell2);

                                tbody.appendChild(newRow);

                                jum = index;
                            });
                        }

                        if (jum >= 1 && stat) {
                            document.querySelector('#antrian-selanjutnya').style.display = 'block';
                        } else {
                            document.querySelector('#antrian-selanjutnya').style.display = 'none';
                        }
                    }


                    // var data = e.data;
                    // console.log(jum);

                    // document.querySelector('#poly' + data.poly_initial).innerHTML = data.id ? data.antrian :
                    //     data.value;
                    // var n = 1;
                    // e.data.forEach(function(nomor){
                    //     // console.log(tes);
                    //     if(nomor != null){
                    //         console.log(nomor.nomor_antrian);
                    //         document.querySelector('#nomor'+n).innerHTML = nomor.poly_initial + nomor.nomor_antrian;
                    //     } else {
                    //         document.querySelector('#nomor'+n).innerHTML = '-';
                    //         // console.log('no');
                    //     }
                    //     n++;
                    // });

                });
        });
</script>

<script>
    $('#ambil-antrian').click(function() {
            stat = 1;
            // console.log($('#poli').val());
            var tbody = document.getElementById("table-content");
            var antrian = tbody.getElementsByTagName("tr")[0] ? tbody.getElementsByTagName("tr")[0].cells[1]
                .textContent : '-';
            var antrian2 = tbody.getElementsByTagName("tr")[1] ? tbody.getElementsByTagName("tr")[1].cells[1]
                .textContent : '-';
            $.ajax({
                url: '{{ url('/getAntrian') }}' + '/' + antrian,
                type: "POST",
                dataType: 'JSON',
                data: {
                    _token: '{{ csrf_token() }}',
                    doctor_id: '{{ $doctors->id }}',
                    // antrian: {{ request()->page }}
                },
                success: function(response) {
                    // console.log(response.data);
                    document.querySelector('#nomor').innerHTML = response.data;
                    document.querySelector('#ambil-antrian').style.display = 'none';
                    if (antrian2 !== '-') {
                        document.querySelector('#antrian-selanjutnya').style.display = 'block';
                    } else {
                        document.querySelector('#antrian-selanjutnya').style.display = 'none';
                    }
                    document.querySelector('#hapus-antrian').style.display = 'block';
                }
            })
        });

        $('#antrian-selanjutnya').click(function() {
            stat = 1;
            var tbody = document.getElementById("table-content");
            var antrian = tbody.getElementsByTagName("tr")[0] ? tbody.getElementsByTagName("tr")[0].cells[1]
                .textContent : '-';
            // console.log($('#poli').val());
            $.ajax({
                url: '{{ url('/nextAntrian') }}' + '/' + antrian,
                type: "POST",
                dataType: 'JSON',
                data: {
                    _token: '{{ csrf_token() }}',
                    doctor_id: '{{ $doctors->id }}',
                    // antrian: {{ request()->page }}
                },
                success: function(response) {
                    // console.log(response.data);
                    // console.log(response.err);
                    var antrian2 = tbody.getElementsByTagName("tr")[1] ? tbody.getElementsByTagName(
                        "tr")[1].cells[1].textContent : '-';
                    if (antrian2 !== '-') {
                        document.querySelector('#antrian-selanjutnya').style.display = 'block';
                    } else {
                        document.querySelector('#antrian-selanjutnya').style.display = 'none';
                    }
                    document.querySelector('#nomor').innerHTML = response.data;
                    // Append the new row to the tbody
                }
            })
        });

        $('#hapus-antrian').click(function() {
            stat = 0;
            // console.log($('#poli').val());
            var tbody = document.getElementById("table-content");
            var antrian = tbody.getElementsByTagName("tr")[0] ? tbody.getElementsByTagName("tr")[0].cells[1]
                .textContent : '-';
            $.ajax({
                url: '{{ url('/deleteAntrian') }}' + '/' + antrian,
                type: "POST",
                dataType: 'JSON',
                data: {
                    _token: '{{ csrf_token() }}',
                    doctor_id: '{{ $doctors->id }}',
                    // antrian: {{ request()->page }}
                },
                success: function(response) {
                    document.querySelector('#nomor').innerHTML = response.data;
                    document.querySelector('#ambil-antrian').style.display = 'block';
                    document.querySelector('#hapus-antrian').style.display = 'none';
                    document.querySelector('#antrian-selanjutnya').style.display = 'none';
                }
            })
        });
</script>
{{-- <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> --}}

{{-- <script>
    $(document).ready(function() {
        var dataTable = $('#myTable').DataTable({
            //processing: true,
            serverside: true,
            ajax: "{{ url('/antrian-send')}}",
            columns: [{
                data: 'queue_number',
                name: 'Nomor Antrian'
            }]
        });

        function autoReloadTable() {
            dataTable.ajax.reload(null, false); // Set 'false' untuk menghindari reset paging
        }
        setInterval(autoReloadTable, 5000);

        $('#deleteQueueBtn').click(function() {
            $.ajax({
                url: "{{ url('/delete-antrian') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Update tampilan daftar pasien setelah penghapusan
                    $('#patientList').empty();
                    response.patients.forEach(function(patient) {
                        $('#patientList').append('<li>' + patient.queue_number + '</li>');
                    });
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        var antrianValue = null;

        function getAntrian() {
            $.ajax({
                url: "{{ route('sekAntrian') }}",
                type: 'GET',
                success: function(response) {
                    if (response) {
                        antrianValue = response;
                        console.log('testing')
                        $('#nomor-antrian').text(response);
                    } else {
                        $('#nomor-antrian').text('Tidak ada nomor antrian');
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }
        getAntrian();
        setInterval(getAntrian, 5000);

        function kirimNilaiKeController() {
            $.ajax({
                url: "{{ url('/testevent') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Diperlukan untuk keamanan CSRF
                    nilai: antrianValue
                },
                success: function(response) {
                    console.log(response.message);
                    // Lakukan tindakan lain setelah berhasil mengirim nilai.
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }
        kirimNilaiKeController();
        setInterval(kirimNilaiKeController, 5000);
    })
</script> --}}
@endsection