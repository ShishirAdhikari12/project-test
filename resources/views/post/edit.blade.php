<x-app-layout>
    <div class="py-4">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-semibold text-blue-900 mb-4">Update Post: <strong
                    class="text-black font-bold italic text-2xl">{{ $post->title }}</strong></h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('put')

                    @if ($post->imageUrl('large'))
                        <div class="">
                            <img src="{{ $post->imageUrl('large') }}" alt="image"
                                class="w-full h-[50vh] object-cover">
                        </div>
                    @endif

                    <!-- Image -->
                    <x-input-label for="image" :value="__('Image')" />
                    <x-text-input
                        class="cursor-pointer bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full shadow-xs placeholder:text-body file:mr-4 file:py-2 file:px-4 file:rounded-l file:border-0 file:text-sm file:font-medium file:bg-black file:text-white hover:file:bg-gray-800"
                        id="image" type="file" name="image" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />

                    <!-- Title -->
                    <div class="mt-4">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                            :value="old('title', $post->title)" autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Category -->
                    <div class="mt-4">
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select name="category_id" id="category_id"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-brand text-sm text-gray-700 bg-white">
                            <option value="">Select a Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <!-- Content -->
                    <div class="mt-4">
                        <x-input-label for="content" :value="__('Content')" />
                        <x-text-area-input id="content" class="block mt-1 w-full" rows="6" name="content"
                            :value="old('content', $post->content)">{{ old('content', $post->content) }}</x-text-area-input>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    <!-- Published At -->
                    <div class="mt-4">
                        <x-input-label for="published_at" :value="__('Published At')" />
                        <x-text-input id="published_at" class="block mt-1 w-full" type="datetime-local" name="published_at"
                            :value="old('published_at', ($post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('Y-m-d\TH:i') : now()->setTimezone(config('app.timezone'))->format('Y-m-d\TH:i')))" />
                        <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
                    </div>

                    <x-primary-button class="mt-4">Update</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
