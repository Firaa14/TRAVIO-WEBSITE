@extends('layouts.app')

@section('title', 'Profile | Travio')

@section('content')
    @include('components.navbar')
    @include('components.heroprofile', ['userName' => $user->name ?? 'User'])
    <div class="container py-5">

        {{-- ✅ Alert success / error --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row align-items-center mb-5">
            <div class="col-md-3 text-center">
                <img id="profilePhotoPreview" src="{{ $user->photo ?? '/images/default-avatar.png' }}"
                    class="rounded-circle shadow-sm mb-3" style="width: 150px; height: 150px; object-fit: cover;"
                    alt="Profile Photo">

                <form action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="photo" class="form-control mb-2" accept="image/*"
                        onchange="previewProfilePhoto(event)">
                    <button type="submit" class="btn btn-primary w-100">Change Photo</button>
                </form>
                <script>
                    function previewProfilePhoto(event) {
                        const input = event.target;
                        if (input.files && input.files[0]) {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                document.getElementById('profilePhotoPreview').src = e.target.result;
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>
            </div>

            <div class="col-md-9">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="border rounded p-3 bg-light">
                            <strong>Full Name:</strong><br>{{ $user->name ?? '-' }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded p-3 bg-light">
                            <strong>Phone:</strong><br>{{ $user->phone ?? 'Not set' }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded p-3 bg-light">
                            <strong>Username:</strong><br>{{ $user->username ?? 'Not set' }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded p-3 bg-light">
                            <strong>Email:</strong><br>{{ $user->email ?? 'Not set' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 🧳 Booking History --}}
        <div class="mb-5">
            <h5 class="fw-bold mb-3">Booking History</h5>
            @if(count($bookings) > 0)
                <ul class="list-group">
                    @foreach($bookings as $booking)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $booking['title'] }}</strong> — {{ $booking['location'] }}
                                <br><small class="text-muted">{{ $booking['date'] }}</small>
                            </div>
                            <span class="badge bg-success">{{ $booking['status'] }}</span>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-3 text-end">
                    <a href="#" class="text-decoration-none fw-bold" style="color:#12395D;">See full history as pdf</a>
                </div>
            @else
                <p class="text-muted">You have no previous bookings.</p>
            @endif
        </div>

        {{-- 🎁 Reward Points --}}
        <div class="mb-5">
            <h5 class="fw-bold mb-3">Reward Points</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="border rounded p-3 bg-light">
                        <strong>Total Points:</strong><br>{{ $user->points ?? 0 }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border rounded p-3 bg-light">
                        <strong>Points Expiry:</strong><br>{{ $user->points_expiry ?? '2025-12-31' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- 📝 Edit Profile --}}
        <div class="mb-5">
            <h5 class="fw-bold mb-3">Edit Profile</h5>

            <form action="{{ route('profile.update') }}" method="POST" class="p-4 border rounded shadow-sm bg-white">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name ?? '') }}"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}"
                            class="form-control @error('email') is-invalid @enderror">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}"
                            class="form-control @error('phone') is-invalid @enderror">
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" id="password" name="password"
                            class="form-control @error('password') is-invalid @enderror">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>

    </div>
    <style>
        html,
        body {
            overflow-x: hidden !important;
            width: 100vw;
            box-sizing: border-box;
        }
    </style>
@endsection