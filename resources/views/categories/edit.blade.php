<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit category') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Edit category') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Fill in data.") }}
                            </p>
                        </header>

                        <form action="{{ route('categories.update',$category->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div>
                                <x-input-label for="image" :value="__('Category image')" />
                                <x-text-input id="image" name="image" type="text" class="mt-1 block w-full" required autofocus
                                              autocomplete="image" value="{{ $category->image }}"/>
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            </div>

                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required
                                              autofocus autocomplete="name" value="{{ $category->name }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" required autofocus autocomplete="description" value="{{ $category->description }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <div>
                                <x-input-label for="sortby" :value="__('Sort order')" />
                                <x-text-input id="sortby" name="sortby" type="number" class="mt-1 block w-full" required
                                              autocomplete="sortby" value="{{ $category->sortby }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('sortby')" />
                            </div>

                            <div>
                                <input type="hidden" name="active" value="0" />
                                <x-input-label for="active" :value="__('Active')" />
                                <input type="checkbox" id="active" name="active" autocomplete="active"
                                       @if ($category->active) checked="checked" @endif value="1"/>
                                <x-input-error class="mt-2" :messages="$errors->get('active')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Update') }}</x-primary-button>

                                @if (session('status') === 'category-changed')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Changed.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
