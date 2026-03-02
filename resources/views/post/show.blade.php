<x-app-layout>
    <div class="py-4">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Upper Section --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                {{-- Title  --}}
                <h1 class="text-4xl mb-5 font-bold">{{ $post->title }}</h1>

                <div class="flex gap-2 items-center">
                    <a href="{{ route('profile.show', $post->user) }}">
                        {{-- Avatar --}}
                        <x-user-avatar :user="$post->user" />
                    </a>

                    <div>
                        {{-- Name and follo button  --}}
                        <div class="flex gap-2">
                            <a href="{{ route('profile.show', $post->user) }}"
                                class="font-semibold hover:underline">{{ $post->user->name }}</a>
                            {{-- <span class="text-natural-500"> • </span> --}}
                            @auth
                                &middot;
                            @endauth
                            @if (auth()->user() && auth()->user()->id !== $post->user->id)
                                <div x-data="{
                                    following: {{ $post->user->isFollowedBy(auth()->user()) ? 'true' : 'false' }},
                                    follow() {
                                        axios.post('/follow/{{ $post->user->id }}')
                                            .then(res => {
                                                this.following = !this.following
                                                {{-- console.log('success') --}}
                                            })
                                            .catch(err => {
                                                console.log(err)
                                            })
                                    }
                                }" class="w-fit">
                                    @auth
                                        <button @click="follow()" class="">
                                            <span x-text="following ? 'Unfollow' : 'Follow'" class="text-sm"
                                                :class="following ? 'text-neutral-500' : 'text-green-500'">Follow</span>
                                        </button>
                                    @endauth
                                </div>
                            @endif
                        </div>
                        {{-- Time to read and date  --}}
                        <div class="flex gap-2 text-sm text-neutral-500">
                            <span>{{ $post->readTime() }} mins read</span>
                            {{-- <span class="text-natural-500"> • </span> --}}
                            &middot;
                            <span>{{ $post->created_at->format('M d, Y') }}</span>
                            {{-- {{ dd($post->created_at) }} --}}

                        </div>

                    </div>
                </div>

                {{-- Clap section  --}}
                <div class="border-t border-b border-neutral-100 mt-8 p-4 flex items-center gap-1">
                    <x-clap-button :post="$post" />
                </div>


            </div>

            {{-- Lower Section (content section) --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 mt-2 ">
                {{-- image  --}}
                <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="object-cover w-full max-h-[80vh]">

                {{-- content  --}}
                <div class="mt-4">
                    {{-- {{ $post->content }} --}}
                    {!! nl2br(e($post->content)) !!}
                </div>

                {{-- Category name  --}}
                <div class="m-4 mt-8">
                    <span
                        class="py-3 px-6 bg-neutral-200 hover:bg-neutral-400 text-neutral-900 hover:text-black rounded-full ">{{ $post->category->name }}</span>
                </div>

                {{-- Clap section  --}}
                <div class="border-t border-b border-neutral-100 mt-8 p-4 flex items-center gap-1">
                    <x-clap-button :post="$post" />
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
