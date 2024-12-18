@section('title', 'Beranda')

<x-app-layout>
    <div class="py-12">
        <div>

            {{-- batas --}}
            <div class="relative isolate hero rounded-lg p-4">
                <svg viewBox="0 0 1108 632" aria-hidden="true"
                    class="absolute top-10 -z-10 max-w-none transform-gpu blur-3xl lg:top-[calc(50%-30rem)]">
                    <path fill="url(#175c433f-44f6-4d59-93f0-c5c51ad5566d)" fill-opacity=".2"
                        d="M235.233 402.609 57.541 321.573.83 631.05l234.404-228.441 320.018 145.945c-65.036-115.261-134.286-322.756 109.01-230.655C968.382 433.026 1031 651.247 1092.23 459.36c48.98-153.51-34.51-321.107-82.37-385.717L810.952 324.222 648.261.088 235.233 402.609Z">
                    </path>
                    <defs>
                        <linearGradient id="175c433f-44f6-4d59-93f0-c5c51ad5566d" x1="1220.59" x2="-85.053"
                            y1="432.766" y2="638.714" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#4F46E5"></stop>
                            <stop offset="1" stop-color="#80CAFF"></stop>
                        </linearGradient>
                    </defs>
                </svg>

                {{-- <div class="hero min-h-screen w-full h-screen"
                    style="background-image: url(https://img.daisyui.com/images/stock/photo-1507358522600-9f71e620c44e.webp);">
                    <div class="hero-overlay bg-opacity-60"></div>
                    <div class="hero-content text-neutral-content text-center">
                        <div class="max-w-md">
                            <h1 class="mb-5 text-5xl font-bold">Hello there</h1>
                            <p class="mb-5">
                                Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi
                                exercitationem
                                quasi. In deleniti eaque aut repudiandae et a id nisi.
                            </p>
                            <button class="btn btn-primary">Get Started</button>
                        </div>
                    </div>
                </div> --}}
                {{-- start --}}
                <div class="carousel w-full">
                    <div id="slide1" class="carousel-item relative w-full active">
                        <img src="https://img.daisyui.com/images/stock/photo-1625726411847-8cbb60cc71e6.webp"
                            class="w-full" />
                        <div class="carousel-caption">
                            <h2 class="text-3xl font-bold text-white">Pengenalan Material Konstruksi</h2>
                            <p class="mt-2 text-white">Temukan berbagai jenis material yang digunakan dalam proyek
                                konstruksi, dari beton hingga baja, dan pahami fungsinya.</p>
                        </div>
                    </div>

                    <div id="slide2" class="carousel-item relative w-full">
                        <img src="https://img.daisyui.com/images/stock/photo-1609621838510-5ad474b7d25d.webp"
                            class="w-full" />
                        <div class="carousel-caption">
                            <h2 class="text-3xl font-bold text-white">Teknik Pemasangan Struktur Bangunan</h2>
                            <p class="mt-2 text-white">Pelajari teknik-teknik yang digunakan dalam pemasangan struktur
                                bangunan yang kuat dan efisien.</p>
                        </div>
                    </div>

                    <div id="slide3" class="carousel-item relative w-full">
                        <img src="https://img.daisyui.com/images/stock/photo-1414694762283-acccc27bca85.webp"
                            class="w-full" />
                        <div class="carousel-caption">
                            <h2 class="text-3xl font-bold text-white">Keselamatan Konstruksi di Lapangan</h2>
                            <p class="mt-2 text-white">Pahami prosedur keselamatan kerja yang harus diterapkan untuk
                                menghindari kecelakaan di lokasi proyek konstruksi.</p>
                        </div>
                    </div>

                    <div id="slide4" class="carousel-item relative w-full">
                        <img src="https://img.daisyui.com/images/stock/photo-1665553365602-b2fb8e5d1707.webp"
                            class="w-full" />
                        <div class="carousel-caption">
                            <h2 class="text-3xl font-bold text-white">Penggunaan Alat Berat dalam Konstruksi</h2>
                            <p class="mt-2 text-white">Pelajari cara mengoperasikan alat berat seperti crane, excavator,
                                dan bulldozer untuk proyek konstruksi yang lebih efisien.</p>

                            <button class="btn btn-primary">Get Started</button>
                        </div>
                    </div>
                </div>

                <script>
                    let currentIndex = 0;
                    const slides = document.querySelectorAll('.carousel-item');
                    const totalSlides = slides.length;

                    function moveToNextSlide() {
                        slides[currentIndex].classList.remove('active');
                        currentIndex = (currentIndex + 1) % totalSlides;
                        slides[currentIndex].classList.add('active');
                    }

                    setInterval(moveToNextSlide, 3000); // Change slide every 3 seconds
                </script>

                <style>
                    .carousel-item {
                        display: none;
                    }

                    .carousel-item.active {
                        display: block;
                    }

                    .carousel-caption {
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        text-align: center;
                        color: white;
                        background: rgba(0, 0, 0, 0.5);
                        padding: 20px;
                        border-radius: 10px;
                    }
                </style>

                {{-- end --}}
            </div>

            <div class="max-w-7xl sm:px-6 lg:px-8">

                <div class="py-12">
                    <h2 class="font-bold text-center md:text-3xl text-lg">Daftar Kursus</h2>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 grid-cols-1 gap-5 p-4">
                        @forelse ($latestCourse as $course)
                            <x-card.card-image title="{{ $course->title }}"
                                image="{{ $course->cover ? 'storage/course/' . $course->cover : 'assets/images/no-image.png' }}"
                                class="static">
                                {{-- <p>{{ $course->excerpt }}</p> --}}
                                <p class="font-bold">Total Durasi <span
                                        class="badge badge-primary">{{ $course->duration }} Menit
                                    </span></p>
                                <div class="card-actions md:justify-end justify-start items-center">
                                    @if (now()->lte($course->start_date))
                                        <div class="badge badge-outline">No Public</div>
                                    @else
                                        <div class="badge badge-outline">Terakhir diupdate</div>
                                        <div class="badge badge-outline">{{ $course->updated_at->diffForHumans() }}
                                        </div>
                                    @endif
                                </div>
                                @if (now()->lte($course->start_date))
                                    <x-button.primary-button class="btn-md text-base-100 w-full"
                                        disabled="disabled">Learn
                                        Now</x-button.primary-button>
                                @else
                                    <a href="{{ url('/course/' . $course->slug) }}" class="mt-4 block">
                                        <x-button.primary-button class="btn-md text-base-100 w-full">
                                            Learn Now
                                        </x-button.primary-button>
                                    </a>
                                @endif
                            </x-card.card-image>
                        @empty
                            <x-card.card-default class="static md:col-span-2 lg:col-span-4 col-span-1">
                                <div class="flex flex-col w-full border-opacity-50">
                                    <div class="grid h-20 card bg-base-300 rounded-box place-items-center">Data Tidak
                                        Ditemukan
                                    </div>
                                </div>
                            </x-card.card-default>
                        @endforelse
                    </div>
                    <div class="mt-3 flex justify-center">
                        <a href="{{ url('/course') }}">
                            <x-button.primary-button class="ms-3" type="button">
                                {{ __('Lihat Semua') }}
                            </x-button.primary-button>
                        </a>
                    </div>
                </div>



            </div>
            {{--  --}}
        </div>
    </div>
</x-app-layout>
