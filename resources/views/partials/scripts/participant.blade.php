<script>
    const role = "{{ auth()->user()->roles->pluck('name')[0] }}";
    const enroll = "{{ auth()->user()->participant?->enrolls?->count() }}";

    if (role == 'participant' && enroll > 0) {
        new Chart($('#courseStatus').get(0).getContext('2d'), {
            type: 'doughnut',
            options: {
                onClick: function(event, elements) {
                    if (elements.length > 0) {
                        const index = elements[0].index;
                        const filter = index === 0 ? 'active' : 'inactive';
                        const url = `/dashboard?search=&filter=${filter}#course`;
                        window.location.href = url;
                    }
                },
            },
            data: {
                labels: ['Aktif', 'Belum Aktif'],
                datasets: [{
                    label: 'Kursus Aktif & Belum Aktif',
                    data: [{{ $totalActive }}, {{ $totalInActive }}],
                    backgroundColor: [
                        'rgb(77, 182, 172)',
                        'rgb(255, 159, 64)',
                    ],
                    color: '#ffff',
                    hoverOffset: 4
                }]
            },
        });


        new Chart($('#courseCompleted').get(0).getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Selesai', 'Belum Selesai'],
                datasets: [{
                    label: 'Kursus Selesai & Belum Selesai',
                    data: [{{ $totalCompleted }},
                        {{ $totalNotCompleted }}
                    ],
                    backgroundColor: [
                        'rgb(28, 170, 103)',
                        'rgb(239, 83, 80)',
                    ],
                    color: '#ffff',
                    hoverOffset: 4
                }]
            },
        });


        new Chart($('#courseProgress').get(0).getContext('2d'), {
            type: 'bar',
            options: {
                indexAxis: 'y',
                onClick: function(event, elements) {
                    if (elements.length > 0) {
                        const index = elements[0].index;
                        const courseId = {!! json_encode($totalProgress?->pluck('slug')) !!}[index];
                        const url = `/course/${courseId}`;
                        window.location.href = url;
                    }
                },
            },
            data: {
                labels: {!! json_encode($totalProgress?->pluck('title')) !!},
                datasets: [{
                    axis: 'y',
                    label: 'Progress (%)',
                    data: {!! json_encode($totalProgress?->pluck('progress')) !!},
                    backgroundColor: [
                        'rgba(77, 182, 172, 0.5)',
                        'rgba(255, 159, 64, 0.5)',
                        'rgba(28, 170, 103, 0.5)',
                        'rgba(239, 83, 80, 0.5)',
                    ],
                    borderColor: [
                        'rgba(77, 182, 172, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(28, 170, 103, 1)',
                        'rgba(239, 83, 80, 1)',
                        'rgba(66, 133, 244, 1)',
                    ],
                    borderWidth: 1,
                    color: '#ffff',
                    hoverOffset: 4
                }]
            },
        });


        new Chart($('#courseDone').get(0).getContext('2d'), {
            type: 'line',
            data: {
                labels: @json($chartData['labels']),
                datasets: [{
                    label: 'Kursus Selesai',
                    data: @json($chartData['data']),
                    fill: false,
                    borderWidth: 2,
                    borderColor: 'rgb(66, 133, 244)', // Soft blue for line
                    color: '#ffff',
                    tension: 0.1,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                        }
                    }
                }
            }
        });
    }
</script>
