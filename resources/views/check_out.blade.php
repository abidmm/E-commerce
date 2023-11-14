<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($orders->isEmpty())
                        No Orders
                    @else
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Order NO
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            DETAILS
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            TOTAL AMOUNT
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $orderno => $order)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4">
                                                {{ $orderno }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @foreach ($order as $details)
                                                    {{ $details->title }}({{ $details->quantity }})
                                                    {{ $details->total_amount }}<br>
                                                @endforeach
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $totalAmount[$orderno] }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
