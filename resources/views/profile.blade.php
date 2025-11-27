@extends('layouts.app')

@section('title', 'Profile | Travio')

@section('content')
    @include('components.navbar')
    @include('components.heroprofile', ['userName' => $user->name ?? 'User'])
    <div class="container py-5">
        <div class="profile-header mb-5 p-4 rounded shadow-sm d-flex align-items-center justify-content-between"
            style="background:linear-gradient(90deg,#28a745,#20c997);color:#fff;">
            <div class="d-flex align-items-center">
                <img id="profilePhotoPreview" src="{{ $user->photo ?? '/images/default-avatar.png' }}"
                    class="rounded-circle shadow-lg me-3 profile-avatar"
                    style="width: 100px; height: 100px; object-fit: cover; border:4px solid #fff;" alt="Profile Photo">
                <div>
                    <h2 class="fw-bold mb-1">{{ $user->name ?? 'User' }}</h2>
                    <div><i class="bi bi-person-badge"></i> {{ $user->username ?? '-' }}</div>
                    <div><i class="bi bi-envelope"></i> {{ $user->email ?? '-' }}</div>
                </div>
            </div>
            <div>
                <span class="badge bg-light text-success fs-6 px-3 py-2"><i
                        class="bi bi-star-fill me-1"></i>{{ $user->points ?? 0 }} pts</span>
            </div>
        </div>

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
                <form action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="photo" class="form-control mb-2" accept="image/*"
                        onchange="previewProfilePhoto(event)">
                    <button type="submit" class="btn btn-success w-100"><i class="bi bi-upload me-1"></i>Change
                        Photo</button>
                </form>
            </div>
            <div class="col-md-9">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="border rounded p-3 bg-white shadow-sm d-flex align-items-center">
                            <i class="bi bi-person-fill fs-3 text-success me-3"></i>
                            <div><strong>Full Name:</strong><br>{{ $user->name ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded p-3 bg-white shadow-sm d-flex align-items-center">
                            <i class="bi bi-telephone-fill fs-3 text-success me-3"></i>
                            <div><strong>Phone:</strong><br>{{ $user->phone ?? 'Not set' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded p-3 bg-white shadow-sm d-flex align-items-center">
                            <i class="bi bi-person-badge fs-3 text-success me-3"></i>
                            <div><strong>Username:</strong><br>{{ $user->username ?? 'Not set' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded p-3 bg-white shadow-sm d-flex align-items-center">
                            <i class="bi bi-envelope-fill fs-3 text-success me-3"></i>
                            <div><strong>Email:</strong><br>{{ $user->email ?? 'Not set' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 🧳 Booking History --}}
        <div class="mb-5">
            <h5 class="fw-bold mb-3"><i class="bi bi-journal-bookmark-fill text-success me-2"></i>Booking History</h5>
            @if(count($bookings) > 0)
                <ul class="list-group list-group-flush">
                    @foreach($bookings as $booking)
                        <li class="list-group-item d-flex justify-content-between align-items-center animated-list">
                            <div>
                                <strong>{{ $booking['title'] }}</strong> — {{ $booking['location'] }}
                                <br><small class="text-muted"><i
                                        class="bi bi-calendar-event me-1"></i>{{ $booking['date'] }}</small>
                            </div>
                            <span class="badge bg-success px-3 py-2">{{ $booking['status'] }}</span>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-3 text-end">
                    <a href="{{ route('profile.bookings.pdf') }}" target="_blank" class="text-decoration-none fw-bold"
                        style="color:#12395D;">
                        <i class="bi bi-file-earmark-pdf me-1"></i>Download full history as PDF
                    </a>
                </div>
            @else
                <p class="text-muted">You have no previous bookings.</p>
            @endif
        </div>

        {{-- 🎁 Reward Points --}}
        <div class="mb-5">
            <h5 class="fw-bold mb-3"><i class="bi bi-gift text-success me-2"></i>Reward Points</h5>
            <div class="row g-3">
                <div class="col-md-8">
                    <div class="border rounded p-3 bg-white shadow-sm">
                        <strong>Total Points:</strong>
                        <div class="progress mt-2" style="height:24px;">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width:{{ min(100, ($user->points ?? 0) / 30) }}%">{{ $user->points ?? 0 }} pts</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="border rounded p-3 bg-white shadow-sm">
                        <strong>Points Expiry:</strong><br><i
                            class="bi bi-calendar-check me-1"></i>{{ $user->points_expiry ?? '2025-12-31' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- 📝 Edit Profile --}}
        <div class="mb-5">
            <h5 class="fw-bold mb-3"><i class="bi bi-pencil-square text-success me-2"></i>Edit Profile</h5>
            <form action="{{ route('profile.update') }}" method="POST"
                class="p-4 border rounded shadow-sm bg-white animated-form">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label"><i class="bi bi-person-fill me-1"></i>Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name ?? '') }}"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label"><i class="bi bi-envelope-fill me-1"></i>Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}"
                            class="form-control @error('email') is-invalid @enderror">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label"><i class="bi bi-telephone-fill me-1"></i>Phone Number</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}"
                            class="form-control @error('phone') is-invalid @enderror">
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label"><i class="bi bi-key-fill me-1"></i>New Password</label>
                        <input type="password" id="password" name="password"
                            class="form-control @error('password') is-invalid @enderror">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary btn-animated"><i
                            class="bi bi-x-lg me-1"></i>Cancel</a>
                    <button type="submit" class="btn btn-success btn-animated"><i class="bi bi-save me-1"></i>Save
                        Changes</button>
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

        .profile-header {
            animation: fadeInDown 1s;
        }

        .profile-avatar {
            transition: box-shadow 0.3s, transform 0.3s;
        }

        .profile-avatar:hover {
            box-shadow: 0 8px 32px rgba(40, 167, 69, 0.15);
            transform: scale(1.05);
        }

        .animated-list {
            animation: fadeInUp 0.7s;
        }

        .animated-form {
            animation: fadeIn 1s;
        }

        .btn-animated {
            transition: background 0.3s, transform 0.2s;
        }

        .btn-animated:hover {
            background: linear-gradient(90deg, #28a745, #20c997);
            color: #fff;
            transform: scale(1.04);
        }

        .progress-bar {
            font-weight: bold;
            font-size: 1rem;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection