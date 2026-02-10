<div>
    <div class="flex bg-neutral-primary-soft border border-default rounded-base shadow-xs mb-8">
        <div class="flex-1 p-5">
            <a href="#">
                <h5 class="mt-3 mb-2 text-2xl font-semibold tracking-tight text-heading">{{ $post->title }}</h5>
            </a>
            <div class="mb-2 text-body">{{ Str::words($post->content, 20) }}</div>
            <a href="#"
                class="inline-flex items-center text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                Read more
                <svg class="w-4 h-4 ms-1.5 rtl:rotate-180 -me-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 12H5m14 0-4 4m4-4-4-4" />
                </svg>
            </a>
        </div>

        <a href="#">
            <img class="rounded-r-lg w-48 h-full object-cover" src="https://flowbite.com/docs/images/blog/image-1.jpg"
                alt="" />
        </a>
    </div>
</div>
