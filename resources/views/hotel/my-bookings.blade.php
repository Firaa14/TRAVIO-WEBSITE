@extends('layouts.app')

@section('title', 'My Hotel Bookings')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">My Hotel Bookings</h1>
                        <p class="text-gray-600 mt-2">Manage and view all your hotel reservations</p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm font-medium rounded-lg shadow-sm hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            Dashboard
                        </a>
                        <a href="{{ route('hotels.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            Browse Hotels
                        </a>
                    </div>
                </div>
            </div>

            @if($bookings->count() > 0)
                <div class="space-y-6">
                    @foreach($bookings as $booking)
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="p-6">
                                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                                    <!-- Booking Info -->
                                    <div class="flex-1">
                                        <div class="flex items-start justify-between mb-4">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-900">
                                                    {{ $booking->hotelDetail->nama }}
                                                </h3>
                                                <p class="text-gray-600 flex items-center mt-1">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    {{ $booking->hotelDetail->location }}
                                                </p>
                                            </div>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                                                    {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-800' :
                        ($booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                            'bg-red-100 text-red-800') }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </div>

                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                            <div>
                                                <p class="text-gray-500">Room</p>
                                                <p class="font-medium">{{ $booking->hotelRoom->room_type }}</p>
                                            </div>
                                            <div>
                                                <p class="text-gray-500">Check-in</p>
                                                <p class="font-medium">{{ $booking->check_in->format('d M Y') }}</p>
                                            </div>
                                            <div>
                                                <p class="text-gray-500">Check-out</p>
                                                <p class="font-medium">{{ $booking->check_out->format('d M Y') }}</p>
                                            </div>
                                            <div>
                                                <p class="text-gray-500">Guests</p>
                                                <p class="font-medium">{{ $booking->guests }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Price & Actions -->
                                    <div class="mt-4 lg:mt-0 lg:ml-6 flex flex-col lg:items-end">
                                        <div class="text-right mb-4">
                                            <p class="text-2xl font-bold text-green-600">
                                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ $booking->nights }} night{{ $booking->nights > 1 ? 's' : '' }}
                                            </p>
                                        </div>

                                        <div class="flex space-x-2">
                                            @if($booking->status === 'pending' || $booking->status === 'confirmed')
                                                <form action="{{ route('hotel.booking.cancel', $booking->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to cancel this booking?')"
                                                    class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700 transition duration-200">
                                                        Cancel
                                                    </button>
                                                </form>
                                            @endif

                                            <a href="{{ route('hotels.show', $booking->hotelDetail->hotel_id) }}"
                                                class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 transition duration-200">
                                                View Hotel
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Additional Details (Collapsible) -->
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <div class="flex justify-between items-center text-sm text-gray-600">
                                        <div class="flex space-x-4">
                                            <span>Booking ID: #{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</span>
                                            <span>Booked: {{ $booking->created_at->format('d M Y H:i') }}</span>
                                        </div>

                                        @if($booking->status === 'pending')
                                            <span class="text-yellow-600">⏳ Awaiting confirmation</span>
                                        @elseif($booking->status === 'confirmed')
                                            <span class="text-green-600">✅ Ready for check-in</span>
                                        @else
                                            <span class="text-red-600">❌ Cancelled</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($bookings->hasPages())
                    <div class="mt-8">
                        {{ $bookings->links() }}
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                    <div class="mx-auto h-12 w-12 text-gray-400">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No bookings yet</h3>
                    <p class="mt-2 text-gray-500">You haven't made any hotel bookings. Start exploring our hotels!</p>
                    <div class="mt-6">
                        <a href="{{ route('hotels.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Browse Hotels
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection