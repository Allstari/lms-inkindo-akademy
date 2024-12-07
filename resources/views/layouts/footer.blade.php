<footer class="bg-info text-base-100 lg:mb-0 mb-5">
    <div class="mx-auto max-w-7xl overflow-hidden py-4 px-6 lg:px-8">
        <p class="mt-10 text-center text-xs leading-5">
            <span class="font-semibold">Made with ❤ Inkindo akademy</span>
        </p>

        <!-- Social Media Icons -->
        <div class="flex justify-center mt-4 space-x-4 mb-3">
            @if ($appSetting?->social_media)
                @foreach (json_decode($appSetting->social_media, true) as $socialMedia)
                    <a class="link link-hover" href="{{ $socialMedia['link'] }}"
                        target="_blank">{{ $socialMedia['platform'] }}</a>
                @endforeach
            @else
                <a class="link link-hover" href="#" target="_blank">Instagram</a>
                <a class="link link-hover" href="#" target="_blank">Facebook</a>
            @endif
            {{-- <a href="https://facebook.com" target="_blank" class="text-base-100 hover:text-primary">
                <i class="fab fa-facebook fa-lg"></i>
            </a> --}}
        </div>

        <p class="mt-1 text-center text-xs leading-5">
            <span class="font-semibold">© 2024 Tim 4. </span>
            All rights reserved.
        </p>
    </div>
</footer>

<!-- Add Font Awesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
