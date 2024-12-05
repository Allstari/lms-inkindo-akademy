@extends('layouts.admin')

@section('title', 'Manajemen Pendaftaran')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Manajemen Pendaftaran</h1>

        <!-- Filter Kursus -->
        <div class="form-group">
            <label for="kursus">Pilih Kursus:</label>
            <select id="kursus" class="form-control">
                <option value="All">Semua Kursus</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tabel Data Pendaftaran -->
        <table class="table table-bordered" id="enrollmentTable">
            <thead>
                <tr>
                    <th>ID Pendaftaran</th>
                    <th>Nama Siswa</th>
                    <th>Kursus</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data ini akan diisi dengan AJAX -->
            </tbody>
        </table>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                // Inisialisasi DataTable
                var table = $('#enrollmentTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('dashboard.enrollment.index') }}',
                        data: function(d) {
                            d.kursus = $('#kursus').val(); // Mengirimkan filter kursus
                        }
                    },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'user.name',
                            name: 'user.name'
                        },
                        {
                            data: 'course.title',
                            name: 'course.title'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });

                // Mengubah filter kursus
                $('#kursus').on('change', function() {
                    table.ajax.reload(); // Reload data dengan filter baru
                });
            });
        </script>
    @endpush
@endsection
