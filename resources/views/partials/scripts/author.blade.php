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
                    '#4E73DF', // Biru gelap
                    '#1CC88A', // Hijau mint
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
                    '#36B9CC', // Biru toska
                    '#F6C23E', // Kuning cerah
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
                    '#FF7F50', // Coral
                    '#20B2AA', // SeaGreen
                    '#FFD700', // Gold
                    '#ADD8E6', // LightBlue
                    '#9370DB', // MediumPurple
                ],
                borderColor: [
                    '#FF6343', // Tomato
                    '#3CB371', // MediumSeaGreen
                    '#FFA500', // Orange
                    '#87CEFA', // LightSkyBlue
                    '#8A2BE2', // BlueViolet
                ],
                color: '#ffff',
                hoverOffset: 4
            }]
        },

    });
</script>
