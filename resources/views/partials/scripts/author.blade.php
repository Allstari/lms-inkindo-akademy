<script>
    new Chart($('#totalParticipantInstructor').get(0).getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Peserta', 'Mentor'],
            datasets: [{
                label: 'Total Peserta & Mentor',
                data: [{{ $totalParticipant }},
                    {{ $totalInstructor }}
                ],
                backgroundColor: [
                    '#4E73DF',
                    '#1CC88A',
                ],
                color: '#ffff',
                hoverOffset: 4
            }]
        },

    });

    new Chart($('#totalEnrollment').get(0).getContext('2d'), {
        type: 'pie',
        data: {
            labels: ['Aktif', 'Belum Aktif'],
            datasets: [{
                label: 'Total Peserta Aktif & Belum Aktif',
                data: [{{ $totalEnrollmentActive }},
                    {{ $totalEnrollmentInActive }}
                ],
                backgroundColor: [
                    '#36B9CC',
                    '#F6C23E',
                ],
                color: '#ffff',
                hoverOffset: 4
            }]
        },

    });

    new Chart($('#courseEnroll').get(0).getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: @json($chartDataParticipant->pluck('label')),
            datasets: [{
                label: 'Total Peserta',
                data: @json($chartDataParticipant->pluck('value')),
                backgroundColor: [
                    '#FF7F50',
                    '#20B2AA',
                    '#FFD700',
                    '#ADD8E6',
                    '#9370DB',
                ],
                borderColor: [
                    '#FF6343',
                    '#3CB371',
                    '#FFA500',
                    '#87CEFA',
                    '#8A2BE2',
                ],
                color: '#ffff',
                hoverOffset: 4
            }]
        },

    });
</script>
