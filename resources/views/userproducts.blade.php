{{-- getting all products from table --}}
<?php
use App\Models\Product;
$products = Product::latest()->get();
?>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-24 mx-auto">
                            <div class="flex flex-wrap -m-4">
                                @foreach ($products as $product)
                                    <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
                                        <a class="block relative h-48 rounded overflow-hidden">
                                            <img alt="ecommerce" class="object-cover object-center w-full h-full block"
                                                src="{{asset('storage/'.$product->image)}}">
                                        </a>
                                        <div class="mt-4">
                                            <h2 class="text-yellow-500 title-font text-lg font-medium">
                                                {{ $product->title }}</h2>
                                            {{ $product->quantity }}
                                            <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">
                                                {{ $product->description }}</h3>
                                            <p class="mt-1">{{ $product->price }}</p>
                                            {{-- add to cart --}}
                                            @if ($product->quantity > 0)
                                                <form action="{{ route('addtocart.post', ['id' => $product->id]) }}"
                                                    class="add-cart" method="post">
                                                    @csrf
                                                    <div
                                                        class="rounded-lg relative bg-transparent mt-1 flex flex-row justify-between">
                                                        <div class="flex flex-row">
                                                            <button id="reduce" onclick="dec($(this))" type="button"
                                                                class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-10 h-full rounded-l cursor-pointer outline-none">
                                                                <span class="m-auto text-2xl font-thin">−</span>
                                                            </button>
                                                            <input type="text" id="count"
                                                                class="py-0 px-2 border-0 outline-none focus:outline-none text-center  bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none"
                                                                name="count" value="0" size="2" readonly>
                                                            <button type="button" id="add"
                                                                onclick="increment($(this))"
                                                                class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-10 h-full rounded-r cursor-pointer">
                                                                <span class="m-auto text-2xl font-thin">+</span>
                                                            </button>
                                                        </div>
                                                        <button type="submit"
                                                            class="inline-block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">add
                                                            cart</button>
                                                    </div>
                                                </form>
                                            @else
                                                unavailable
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/addToCart.js') }}"></script>
    <script>
        // const reduce = document.getElementById('reduce');
        // const add = document.getElementById('add');
        // var count = document.getElementById('count').value;

        // reduce.addEventListener('click' , function(){ 
        //     count--
        //     document.getElementById('count').value = count
        // })

        // add.addEventListener('click' , function(){ 
        //     count++
        //     document.getElementById('count').value = count
        // })

        function dec(temp) {
            var count = temp.closest('div').find('#count').val()
            if (count <= 0) {
                temp.prop('disabled', true)
            } else {
                count--
                temp.closest('div').find('#count').val(count)
            }

        }

        function increment(temp) {
            var count = temp.closest('div').find('#count').val()
            const btn = temp.closest('div').find('#reduce')
            if (count > 0) {
                btn.prop('disabled', false)
            }
            count++
            temp.closest('div').find('#count').val(count)
        }
    </script>
</x-app-layout>
