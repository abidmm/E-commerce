<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{-- total items in cart --}}
            Your Cart ({{ count($items) }})
        </h2>
    </x-slot>

    @if ($items->isEmpty())
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        Cart Empty
                        <a href="{{ route('viewproducts') }}"
                            class="transition-colors text-sm bg-white border border-gray-600 p-2 rounded-sm  text-gray-700 text-hover shadow-md">
                            Browse products
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="flex flex-col md:flex-row  h-full px-14 py-7">
            <!-- My Cart -->
            <div class="w-full flex flex-col h-fit gap-4 p-4 ">
                @foreach ($items as $item)
                    <div class="w-full flex flex-col h-fit gap-4 p-4 ">

                        <!-- Product -->
                        <div class="flex flex-col p-4 text-lg font-semibold shadow-md border rounded-sm">
                            <div class="flex flex-col md:flex-row gap-3 justify-between">
                                <!-- Product Information -->
                                <div class="flex flex-row gap-6 items-center">
                                    <div class="w-28 h-28">
                                        <img class="w-full h-full"
                                            src="{{asset('storage/'.$item->product->image)}}">
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <p class="text-lg text-gray-800 font-semibold">{{ $item->product->title }}</p>

                                        <p class="text-xs text-gray-600 font-semibold">Quantity: <span
                                                class="font-normal">{{ $item->quantity }}</span></p>
                                    </div>
                                </div>
                                <!-- Price Information -->
                                <div class="self-center text-center">
                                    <p class="text-emerald-500 font-normal text-xl">{{ $item->total_amount }}</p>
                                </div>
                                <!-- Remove Product Icon -->
                                <div class="self-center">

                                    {{-- delete from cart --}}
                                    <form action="{{ route('deletecart', ['id' => $item->product_id]) }}"
                                        class="deletecart" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-300 deletebtn" type="submit">
                                            <svg class="" height="24px" width="24px" id="Layer_1"
                                                style="enable-background:new 0 0 512 512;" version="1.1"
                                                viewBox="0 0 512 512" xml:space="preserve"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <g>
                                                    <path
                                                        d="M400,113.3h-80v-20c0-16.2-13.1-29.3-29.3-29.3h-69.5C205.1,64,192,77.1,192,93.3v20h-80V128h21.1l23.6,290.7   c0,16.2,13.1,29.3,29.3,29.3h141c16.2,0,29.3-13.1,29.3-29.3L379.6,128H400V113.3z M206.6,93.3c0-8.1,6.6-14.7,14.6-14.7h69.5   c8.1,0,14.6,6.6,14.6,14.7v20h-98.7V93.3z M341.6,417.9l0,0.4v0.4c0,8.1-6.6,14.7-14.6,14.7H186c-8.1,0-14.6-6.6-14.6-14.7v-0.4   l0-0.4L147.7,128h217.2L341.6,417.9z" />
                                                    <g>
                                                        <rect height="241" width="14" x="249" y="160" />
                                                        <polygon points="320,160 305.4,160 294.7,401 309.3,401" />
                                                        <polygon points="206.5,160 192,160 202.7,401 217.3,401" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <!-- Product Quantity -->
                            <div class="flex flex-row self-center gap-1">

                                {{-- updating quantity in cart --}}
                                <form action="{{ route('reduce', ['id' => $item->product->id]) }}" method="post"
                                    class="update-cart">
                                    @csrf
                                    <div class="rounded-lg relative bg-transparent mt-1 flex flex-row justify-between">
                                        <div class="flex flex-row">
                                            {{-- using jquery increment and decrement count of input --}}
                                            {{-- the clicked element is passed to function as parameter --}}
                                            <button id="reduce" onclick="dec($(this))" type="button"
                                                class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-10 h-full rounded-l cursor-pointer outline-none">
                                                <span class="m-auto text-2xl font-thin">−</span>
                                            </button>
                                            <input type="text" id="count"
                                                class="py-0 px-2 border-0 outline-none focus:outline-none text-center  bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none"
                                                name="count" value="{{ $item->quantity }}" size="2" readonly>
                                            <button type="button" id="add" onclick="increment($(this))"
                                                class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-10 h-full rounded-r cursor-pointer">
                                                <span class="m-auto text-2xl font-thin">+</span>
                                            </button>
                                        </div>
                                        <button type="submit"
                                            class="inline-block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Updatecart</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Purchase Resume -->
            <div class="flex flex-col w-full md:w-2/3 h-fit gap-4 p-4">
                <p class="text-blue-900 text-xl font-extrabold">Purchase Resume</p>
                <div class="flex flex-col p-4 gap-4 text-lg font-semibold shadow-md border rounded-sm">
                    @foreach ($final_taxpercentage as $taxper => $tax_amount)
                        <div class="flex flex-row justify-between">
                            <p class="text-gray-600">VAT({{ $taxper }}%)</p>
                            <p class="text-end font-bold text-white">{{ $tax_amount }}</p>
                        </div>
                        <hr class="bg-gray-200 h-0.5">
                    @endforeach
                    <div class="flex flex-row justify-between">
                        <p class="text-gray-600">Total</p>
                        <div>
                            <p class="text-end font-bold text-white"> {{ $final_amount }}</p>
                        </div>
                    </div>
                    <div class="flex gap-2">

                        {{-- checkout from cart and delete all from cart --}}
                        <form action="{{ route('checkout') }}" method="POST" id="checkout">
                            @csrf
                            <button type="submit" id="checkout-btn"
                                class="transition-colors text-sm bg-blue-600 hover:bg-blue-700 p-2 rounded-sm w-full text-white text-hover shadow-md">
                                Check Out
                            </button>
                        </form>
                        <a href="{{ route('viewproducts') }}"
                            class="transition-colors text-sm bg-white border border-gray-600 p-2 rounded-sm  text-gray-700 text-hover shadow-md">
                            ADD MORE PRODUCTS
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script src="{{ asset('js/updateCart.js') }}"></script>
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


        //clicked element is get using $this as parameter in the on click function of button
        //here the clicked element is in temp
        function dec(temp) {
            //to get the value in the input box to update the count
            //using temp the closest div is selected and we find the element with id count.value (input box) within the closest div
            var count = temp.closest('div').find('#count').val()
            if (count <= 0) {
                //button is disabled on condition
                temp.prop('disabled', true)
            } else {
                count--
                //value updated to input box(#count)
                temp.closest('div').find('#count').val(count)
            }

        }

        function increment(temp) {
            var count = temp.closest('div').find('#count').val()
            const btn = temp.closest('div').find('#reduce')
            if (count > 0) {
                //reduce button is enabled oncondition
                btn.prop('disabled', false)
            }
            count++
            temp.closest('div').find('#count').val(count)
        }
    </script>
</x-app-layout>
