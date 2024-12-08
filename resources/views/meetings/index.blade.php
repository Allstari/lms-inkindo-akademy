<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Meeting</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Setup CSRF Token untuk AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <!-- Menambahkan Tailwind dan DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.13.0/dist/full.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto p-6">

        <!-- Heading Section -->
        <h1 class="text-4xl font-semibold text-center mb-8 text-blue-600">Daftar Meeting</h1>

        <!-- Button to Load Meetings -->
        <div class="text-center mb-6">
            <button id="loadMeetings" class="btn btn-primary btn-lg">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
                Tampilkan Meeting
            </button>
        </div>

        <!-- Meeting List Section -->
        <div id="meetingList" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Daftar meeting akan ditampilkan di sini -->
        </div>

        <!-- Horizontal Divider -->
        <hr class="my-8 border-gray-300">

        <!-- Add Meeting Form -->
        <h2 class="text-2xl font-medium text-center mb-4 text-green-600">Tambah Meeting Baru</h2>
        <form id="meetingForm" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg space-y-6">

            <!-- Course ID Input -->
            <div class="form-control">
                <label for="course_id" class="label text-lg">ID Kursus:</label>
                <input type="text" id="course_id" name="course_id" class="input input-bordered w-full"
                    placeholder="Masukkan ID Kursus">
            </div>

            <!-- Meeting Time Input -->
            <div class="form-control">
                <label for="meeting_time" class="label text-lg">Waktu Meeting:</label>
                <input type="text" id="meeting_time" name="meeting_time" class="input input-bordered w-full"
                    placeholder="Masukkan Waktu Meeting">
            </div>

            <!-- Submit Button -->
            <div class="form-control">
                <button type="submit" class="btn btn-success w-full">Buat Meeting</button>
            </div>

        </form>
    </div>

    <script>
        // Mengambil daftar meeting menggunakan AJAX
        $('#loadMeetings').click(function() {
            $.ajax({
                url: '/meetings',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#meetingList').empty();
                    if (response.meetings.length > 0) {
                        response.meetings.forEach(function(meeting) {
                            $('#meetingList').append(`
                                <div class="card bg-white shadow-lg rounded-lg p-4">
                                    <h3 class="font-semibold text-xl text-gray-800">${meeting.course.name}</h3>
                                    <p class="text-gray-600">Waktu: ${meeting.meeting_time}</p>
                                    <div class="mt-4">
                                        <button class="btn btn-info btn-sm">Detail</button>
                                    </div>
                                </div>
                            `);
                        });
                    } else {
                        $('#meetingList').append(`
                            <div class="col-span-3 text-center p-6 text-gray-500">
                                Tidak ada meeting yang ditemukan.
                            </div>
                        `);
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat memuat data meeting');
                }
            });
        });

        // Membuat meeting baru menggunakan AJAX
        $('#meetingForm').submit(function(e) {
            e.preventDefault();
            var formData = {
                course_id: $('#course_id').val(),
                meeting_time: $('#meeting_time').val(),
            };

            $.ajax({
                url: '/meetings',
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        $('#meetingList').prepend(`
                            <div class="card bg-white shadow-lg rounded-lg p-4">
                                <h3 class="font-semibold text-xl text-gray-800">${response.meeting.course.name}</h3>
                                <p class="text-gray-600">Waktu: ${response.meeting.meeting_time}</p>
                                <div class="mt-4">
                                    <button class="btn btn-info btn-sm">Detail</button>
                                </div>
                            </div>
                        `);
                    } else {
                        alert('Gagal membuat meeting');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat menyimpan meeting');
                }
            });
        });
    </script>

</body>

</html>
