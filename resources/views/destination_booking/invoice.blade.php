@extends('layouts.app')

@section('title', 'Invoice - ' . $bookingData['trip']['title'])

@section('content')
    <div class="py-8" style="background: #f8f9fa; min-height: 100vh;">
        <div class="max-w-4xl mx-auto px-8">
            <!-- Invoice Header -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 mb-6">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6 rounded-t-xl">
                    <div class="flex justify-between items-center text-white">
                        <div>
                            <h1 class="text-3xl font-bold">INVOICE</h1>
                            <p class="text-blue-100 mt-1">Destination Booking</p>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold">TRAVIO</div>
                            <div class="text-blue-100 text-sm">Travel & Adventure</div>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <!-- Company Info -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">From:</h3>
                            <div class="text-gray-600 space-y-1">
                                <div class="font-semibold text-blue-800">PT. TRAVIO INDONESIA</div>
                                <div>Jl. Travel Adventure No. 123</div>
                                <div>Jakarta Selatan, 12345</div>
                                <div>Phone: +62 21 1234 5678</div>
                                <div>Email: info@travio.com</div>
                            </div>
                        </div>

                        <!-- Customer Info -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Bill To:</h3>
                            <div class="text-gray-600 space-y-1">
                                <div class="font-semibold text-gray-800">{{ $bookingData['customer']['name'] }}</div>
                                <div>{{ $bookingData['customer']['address'] }}</div>
                                <div>Phone: {{ $bookingData['customer']['phone'] }}</div>
                                <div>Email: {{ $bookingData['customer']['email'] }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Invoice Details -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 p-4 bg-gray-50 rounded-lg">
                        <div>
                            <span class="text-sm font-medium text-gray-600">Invoice Number:</span>
                            <div class="font-mono font-bold text-blue-800">{{ $bookingData['id'] }}</div>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-600">Invoice Date:</span>
                            <div class="font-semibold text-gray-800">{{ $bookingData['date'] }}</div>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-600">Payment Status:</span>
                            <div class="inline-flex px-3 py-1 rounded-full text-sm font-medium
                                    {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
        ($booking->status === 'confirmed' ? 'bg-green-100 text-green-800' :
            'bg-gray-100 text-gray-800') }}">
                                {{ $bookingData['status'] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trip Details -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 mb-6">
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-8 py-4 border-b border-green-100">
                    <h2 class="text-xl font-bold text-green-800">Trip Details</h2>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div>
                            @if($booking->destination->destinasi->image)
                                <img src="{{ asset('photos/' . $booking->destination->destinasi->image) }}"
                                    alt="{{ $bookingData['trip']['title'] }}"
                                    class="w-full h-48 object-cover rounded-xl border-2 border-gray-200 mb-4">
                            @endif

                            <div class="space-y-3">
                                <div>
                                    <span class="text-sm font-medium text-gray-600">Destination:</span>
                                    <div class="text-lg font-bold text-blue-800">{{ $bookingData['trip']['title'] }}</div>
                                </div>
                                <div>
                                    <span class="text-sm font-medium text-gray-600">Location:</span>
                                    <div class="text-gray-800">{{ $bookingData['trip']['location'] }}</div>
                                </div>
                                <div>
                                    <span class="text-sm font-medium text-gray-600">Trip Date:</span>
                                    <div class="text-gray-800 font-semibold">{{ $bookingData['trip']['date'] }}</div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Additional Information</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Number of Participants:</span>
                                    <span class="font-semibold">{{ $bookingData['trip']['participants'] }}
                                        person{{ $bookingData['trip']['participants'] > 1 ? 's' : '' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Payment Method:</span>
                                    <span class="font-semibold">{{ $bookingData['payment_method'] }}</span>
                                </div>
                                @if($booking->emergency_name)
                                    <div class="pt-3 border-t border-gray-200">
                                        <span class="text-sm font-medium text-gray-600">Emergency Contact:</span>
                                        <div class="text-gray-800">{{ $booking->emergency_name }}</div>
                                        <div class="text-gray-600 text-sm">{{ $booking->emergency_phone }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Invoice Items -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 mb-6">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-8 py-4 border-b border-blue-100">
                    <h2 class="text-xl font-bold text-blue-800">Invoice Items</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-8 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                    Description</th>
                                <th
                                    class="px-8 py-4 text-center text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                    Qty</th>
                                <th
                                    class="px-8 py-4 text-right text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                    Unit Price</th>
                                <th
                                    class="px-8 py-4 text-right text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                    Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-8 py-6">
                                    <div class="font-semibold text-gray-800">{{ $bookingData['trip']['title'] }} - Trip
                                        Package</div>
                                    <div class="text-sm text-gray-600">{{ $bookingData['trip']['location'] }}</div>
                                    <div class="text-sm text-gray-500">Trip Date: {{ $bookingData['trip']['date'] }}</div>
                                </td>
                                <td class="px-8 py-6 text-center font-semibold">{{ $bookingData['trip']['participants'] }}
                                </td>
                                <td class="px-8 py-6 text-right font-semibold">Rp
                                    {{ number_format($bookingData['trip']['price_per_person'], 0, ',', '.') }}</td>
                                <td class="px-8 py-6 text-right font-bold text-blue-800">Rp
                                    {{ number_format($bookingData['trip']['total_price'], 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Totals -->
                <div class="bg-gray-50 px-8 py-6 border-t border-gray-200">
                    <div class="flex justify-end">
                        <div class="w-64 space-y-2">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal:</span>
                                <span>Rp {{ number_format($bookingData['trip']['total_price'], 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Tax (0%):</span>
                                <span>Rp 0</span>
                            </div>
                            <div
                                class="flex justify-between text-xl font-bold text-green-600 pt-2 border-t border-gray-300">
                                <span>Total Amount:</span>
                                <span>Rp {{ number_format($bookingData['trip']['total_price'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Instructions -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 mb-6">
                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 px-8 py-4 border-b border-yellow-100">
                    <h2 class="text-xl font-bold text-yellow-800">Payment Instructions</h2>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-3">Bank Transfer</h3>
                            <div class="space-y-2 text-gray-600">
                                <div>Bank: BCA (Bank Central Asia)</div>
                                <div>Account Number: 1234567890</div>
                                <div>Account Name: PT. TRAVIO INDONESIA</div>
                                <div class="text-sm text-red-600 mt-2">
                                    * Please include invoice number in transfer description
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-800 mb-3">Important Notes</h3>
                            <ul class="space-y-1 text-sm text-gray-600">
                                <li>• Payment must be completed within 24 hours</li>
                                <li>• Upload payment proof to confirm booking</li>
                                <li>• Contact customer service for payment issues</li>
                                <li>• Trip confirmation will be sent after payment verification</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="p-8 text-center text-gray-600">
                    <p class="mb-2">Thank you for choosing TRAVIO for your adventure!</p>
                    <p class="text-sm">For questions about this invoice, contact us at support@travio.com or +62 21 1234
                        5678</p>
                    <div class="mt-4 pt-4 border-t border-gray-200 text-xs text-gray-500">
                        This invoice was generated automatically on {{ now()->format('d F Y \a\t H:i') }}
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                <button onclick="window.print()"
                    class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Print Invoice
                </button>
                <a href="{{ route('destination.booking.success', $booking->booking_id) }}"
                    class="inline-flex items-center justify-center px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Back to Booking Details
                </a>
            </div>
        </div>
    </div>

    <!-- Print Styles -->
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .print-area,
            .print-area * {
                visibility: visible;
            }

            .print-area {
                position: absolute;
                left: 0;
                top: 0;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
@endsection