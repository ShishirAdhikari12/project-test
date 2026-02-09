<x-app-layout>


    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 text-gray-900">



                    <ul class="flex flex-wrap text-sm font-medium text-center justify-center text-body">
                        <li class="me-2">
                            <a href="#" class="inline-block px-4 py-2 text-white bg-brand rounded-base active"
                                aria-current="page">All</a>
                        </li>

                        @foreach ($categories as $category)
                        <li class="me-2">
                            <a href="#"
                                class="inline-block px-4 py-2 rounded-base hover:text-heading hover:bg-neutral-secondary-soft">{{
                                $category->name }}</a>
                        </li>
                        @endforeach


                    </ul>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>