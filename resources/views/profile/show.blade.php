<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex flex-col sm:flex-row gap-8 sm:gap-0">
                    {{-- name and post seciton  --}}
                    <div
                        class="sm:w-2/3 order-2 sm:order-1 border-t border-neutral-200 sm:border-t-0 mt-2 pt-2 sm:pt-0 sm:mt-1">
                        {{-- name seciton  --}}
                        <div>
                            <h1 class="text-5xl font-bold">
                                {{ $user->name }}
                            </h1>
                        </div>

                        {{-- post secion  --}}
                        <div class="mt-4 sm:mt-16 sm:pr-4">
                            @forelse ($posts as $post)
                                <x-post-item :post="$post"></x-post-item>
                            @empty
                                <div>
                                    <p class="text-gray-500 m-14 text-center">No Posts Found.</p>
                                </div>
                            @endforelse
                        </div>

                    </div>

                    {{-- profile section  --}}
                    <div x-data="{
                    
                        following: {{ $user->isFollowedBy(auth()->user()) ? 'true' : 'false' }},
                        followersCount: {{ $user->followers()->count() }},
                        follow() {
                            axios.post('/follow/{{ $user->id }}')
                                .then(res => {
                                    this.following = !this.following
                                    this.followersCount = res.data.followersCount
                                })
                                .catch(err => {
                                    console.log(err)
                                })
                        }
                    }"
                        class="sm:w-1/3 sm:border-l border-neutral-200 pl-10 flex flex-col gap-2 order-1 sm:order-2">
                        {{-- avatar  --}}
                        <x-user-avatar :user="$user" size="w-20 h-20" />

                        <h2 class="text-xl font-bold mt-2">{{ $user->name }}</h2>
                        <p class="text-neutral-500 font-medium"><span x-text="followersCount"></span> followers</p>
                        <p class="text-neutral-500 font-medium mb-8">{{ $user->bio }}</p>

                        @if (auth()->user() && auth()->user()->id !== $user->id)
                            <div class="w-fit">
                                @auth
                                    <button @click="follow()" class="py-3 px-6 rounded-full transition-all duration-600"
                                        x-text="following ? 'Unfollow' : 'Follow'"
                                        :class="following ? 'bg-white text-black ring-1 ring-black' : 'bg-black text-white'">

                                    </button>
                                @endauth
                            </div>
                        @endif


                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
