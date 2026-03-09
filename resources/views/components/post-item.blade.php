<div>
    <div class="flex bg-neutral-primary-soft border border-default rounded-base shadow-xs mb-8">
        <div class="flex-1 p-5 pt-2">
            <div>
                <a href="{{ route('profile.show', $post->user) }}" class="mt-2 mb-2 flex items-center">
                    <x-user-avatar :user="$post->user" size="w-6 h-6 " />
                    <span class="text-sm text-neutral-600 pl-2 hover:underline">{{ $post->user->name }}</span>
                </a>
                <a
                    href="{{ route('post.show', [
                        'username' => $post->user->username,
                        'post' => $post->slug,
                    ]) }}">
                    <h5 class="mt-3 mb-2 text-2xl font-semibold tracking-tight text-heading">{{ $post->title }}</h5>
                </a>
                <div class="mb-2 text-body">{{ Str::words($post->content, 20) }}</div>
                {{-- <a
                    href="{{ route('post.show', [
                        'username' => $post->user->username,
                        'post' => $post->slug,
                    ]) }}">

                    <x-primary-button>
                        Read more
                        <svg class="w-4 h-4 ms-1.5 rtl:rotate-180 -me-0.5" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 12H5m14 0-4 4m4-4-4-4" />
                        </svg>
                    </x-primary-button>
                </a> --}}

            </div>
            <div class="flex gap-2 mt-4 mb-2 text-sm font-light text-neutral-500">
                <span class="mr-2">{{ $post->getCreatedAtDate() }}</span>
                <x-clap-button :post="$post" />
            </div>

        </div>

        <a
            href="{{ route('post.show', [
                'username' => $post->user->username,
                'post' => $post->slug,
            ]) }}">
            <img class="rounded-r-lg w-48 h-full max-h-74 object-cover" src="{{ $post->imageUrl('preview') }}"
                alt="post image" />
        </a>
    </div>
</div>
