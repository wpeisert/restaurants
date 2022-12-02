<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

                    <div>
                        <x-primary-button><a href="{{ route('categories.create') }}"> Create New Category &raquo;
                            </a></x-primary-button>
                    </div>

                    {{ __("Your categories") }}

                    <table class="table table-bordered">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Sort by</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                        @each('categories.index_item', $categories, 'category')
                    </table>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
