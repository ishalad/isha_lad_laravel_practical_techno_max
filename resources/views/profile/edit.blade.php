{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Profile</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                <li class="text-danger">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf

        <!-- First Name -->
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" required>
        </div>

        <!-- Last Name -->
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <!-- Phones -->
        <div class="mb-3">
            <label for="phones" class="form-label">Phone Numbers</label>
            <div id="phone-container">
                @foreach(old('phones', $user->phones ?? ['']) as $phone)
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="phone[]" value="{{ $phone }}" required>
                        <button type="button" class="btn btn-danger remove-phone">Remove</button>
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-primary" id="add-phone">Add Phone</button>
        </div>
        @if(!$user->is_admin)
        <!-- Technologies Interested -->
        <div class="mb-3">
            <label for="technology_ids" class="form-label technology_id">Technologies Interested</label>
            <select class="form-control" id="technology_ids" name="technology_ids[]" multiple required>
                @foreach($technologies as $technology)
                    <option value="{{ $technology->id }}" {{ in_array($technology->id, old('technology_ids', $user->technologies->pluck('id')->toArray())) ? 'selected' : '' }}>
                        {{ $technology->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="latitude" class="form-label">Latitude</label>
            <input type="text" class="form-control" id="latitude" name="lat" value="{{ old('latitude', $user->lat) }}" required >
        </div>

        <!-- Longitude -->
        <div class="mb-3">
            <label for="longitude" class="form-label">Longitude</label>
            <input type="text" class="form-control" id="longitude" name="lon" value="{{ old('longitude', $user->lon) }}" required >
        </div>

        <!-- Map -->
        <div class="mb-3">
            <div id="map" style="height: 400px;"></div>
        </div>

    @endif
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtxbC4uhroIy-dEVsKFoqyv-JqD88dgP0&callback=initMap" async defer></script>
<script>

document.addEventListener('DOMContentLoaded', function () {
        // Add phone number functionality
        document.getElementById('add-phone').addEventListener('click', function () {
            const phoneContainer = document.getElementById('phone-container');
            const newPhoneInput = `
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="phones[]" required>
                    <button type="button" class="btn btn-danger remove-phone">Remove</button>
                </div>`;
            phoneContainer.insertAdjacentHTML('beforeend', newPhoneInput);
        });

        // Remove phone number functionality
        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-phone')) {
                event.target.closest('.input-group').remove();
            }
        });

    });

    let map, marker;

    function initMap() {
        const initialPosition = {
            lat: {{ $user->latitude ?? 0 }},
            lng: {{ $user->longitude ?? 0 }}
        };

        map = new google.maps.Map(document.getElementById("map"), {
            center: initialPosition,
            zoom: 8
        });

        marker = new google.maps.Marker({
            position: initialPosition,
            map: map,
            draggable: true
        });

        marker.addListener('dragend', function() {
            const position = marker.getPosition();
            $('#latitude').val(position.lat());
            $('#longitude').val(position.lng());
        });
    }

</script>
@endsection
