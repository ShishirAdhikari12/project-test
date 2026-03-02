<div>
    <ul class="flex flex-wrap text-sm font-medium text-center justify-center text-body">
        <li class="">
            <a href="{{ route('dashboard') }}" class="{{ request('category') ? 'inline-block px-4 py-2 rounded-base hover:text-heading hover:bg-neutral-secondary-soft':'inline-block px-4 py-2 text-white bg-brand rounded-base active' }} "
                aria-current="page">All</a>
        </li>

        @forelse ($categories as $category)
            <li class="">
                <a href="{{ route('post.byCategory', $category) }}"
                    class="{{ Route::currentRouteNamed('post.byCategory') && request('category')->id == $category->id ? 'inline-block px-4 py-2 text-white bg-brand rounded-base active':'inline-block px-4 py-2 rounded-base hover:text-heading hover:bg-neutral-secondary-soft' }} ">{{ $category->name }}</a>
            </li>
        @empty
            {{ $slot }}
        @endforelse
    </ul>
</div>
