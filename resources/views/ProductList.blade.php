<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <!-- Modal toggle -->
                    <button data-modal-target="defaultModal" data-modal-toggle="defaultModal"
                        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">
                        add product
                    </button>

                    <!-- Main modal -->
                    <div id="defaultModal" tabindex="-1" aria-hidden="true"
                        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div
                                    class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Terms of Service
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="defaultModal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <form action="{{ route('addproduct.post') }}" method="POST"
                                    enctype="multipart/form-data" class="mb-4">
                                    @csrf
                                    <div class="p-6 space-y-6">
                                        <div class="mb-6">
                                            <label for="email"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">title</label>
                                            <input type="text" name="title"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="name@flowbite.com" required>
                                        </div>
                                        <div class="mb-6">
                                            <label for="email"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">description</label>
                                            <input type="text" name="description"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="name@flowbite.com" required>
                                        </div>
                                        <div class="mb-6">
                                            <label for="email"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">price</label>
                                            <input type="text" name="price"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="name@flowbite.com" required>
                                        </div>
                                        <div class="mb-6">
                                            <label for="email"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">quantity</label>
                                            <input type="text" name="quantity"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="name@flowbite.com" required>
                                        </div>
                                        <div class="mb-6">
                                            <label for="email"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">tax_percentage</label>
                                            <input type="text" name="tax_percentage"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="name@flowbite.com" required>
                                        </div>
                                        <div class="mb-6">
                                            <label for="email"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">image</label>
                                            <input type="file" name="image"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="name@flowbite.com" required>
                                        </div>
                                    </div>
                                    <!-- Modal footer -->
                                    <div
                                        class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                        <button type="submit" style="background-color: blue"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        title
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        description
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        quantity
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        tax percentage
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        image
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        edit
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4">
                                            {{ $product->title }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $product->description }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $product->quantity }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $product->price }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $product->tax_percentage }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <img src="{{ asset('storage/' . $product->image) }}" alt=""
                                                width="100">
                                        </td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('delete.post', ['id' => $product->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    class="text-white bg-red-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 inline-block">delete</button>
                                            </form>
                                            <!-- Modal toggle -->
                                            <button data-modal-target="default{{ $product->id }}"
                                                data-modal-toggle="default{{ $product->id }}"
                                                class="inline-block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                type="button">
                                                edit
                                            </button>

                                            <!-- Main modal -->
                                            <div id="default{{ $product->id }}" tabindex="-1" aria-hidden="true"
                                                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative w-full max-w-2xl max-h-full">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <!-- Modal header -->
                                                        <div
                                                            class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                            <h3
                                                                class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                Terms of Service
                                                            </h3>
                                                            <button type="button"
                                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                data-modal-hide="default{{ $product->id }}">
                                                                <svg class="w-3 h-3" aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <form
                                                            action="{{ route('editproduct.post', ['id' => $product->id]) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="p-6 space-y-6">
                                                                <div class="mb-6">
                                                                    <label for="email"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">title</label>
                                                                    <input type="text" name="title"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                        placeholder="name@flowbite.com">
                                                                </div>
                                                                <div class="mb-6">
                                                                    <label for="email"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">description</label>
                                                                    <input type="text" name="description"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                        placeholder="name@flowbite.com">
                                                                </div>
                                                                <div class="mb-6">
                                                                    <label for="email"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">price</label>
                                                                    <input type="text" name="price"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                        placeholder="name@flowbite.com">
                                                                </div>
                                                                <div class="mb-6">
                                                                    <label for="email"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">quantity</label>
                                                                    <input type="text" name="quantity"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                        placeholder="name@flowbite.com">
                                                                </div>
                                                                <div class="mb-6">
                                                                    <label for="email"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">tax_percentage</label>
                                                                    <input type="text" name="tax_percentage"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                        placeholder="name@flowbite.com">
                                                                </div>
                                                                <div class="mb-6">
                                                                    <label for="email"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">image</label>
                                                                    <input type="file" name="image"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                        placeholder="name@flowbite.com">
                                                                </div>
                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div
                                                                class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                <button type="submit" style="background-color: blue"
                                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">edit</button>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
