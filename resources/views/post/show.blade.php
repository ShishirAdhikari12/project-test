<x-app-layout>
    <div class="py-4">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h1 class="text-4xl mb-5 font-bold">{{ $post->title }}</h1>

                <div class="flex gap-2 items-center">
                    @if ($post->user->image)
                        <img src="{{ $post->user->imageUrl() }}" alt="{{ $post->user->name }}"
                            class="w-10 h-10 object-cover rounded-full ">
                    @else
                        <img src="/user-avatar.png" alt="avatar" class="w-10 h-10 object-cover rounded-full">
                    @endif

                    <div>
                        <div class="flex gap-2">
                            <h3 class="font-semibold">{{ $post->user->name }}</h3>
                            <span class="text-natural-500"> • </span>
                            <button class="text-green-500">
                                <span>Follow</span>
                            </button>
                        </div>
                        <div class="flex gap-2 text-sm text-neutral-500">
                            <span>{{ $post->readTime() }} mins read</span>
                            <span>{{ $post->created_at }}</span>

                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 mt-2">
                {{ $post->content }}
            </div>
        </div>
    </div>
</x-app-layout>
