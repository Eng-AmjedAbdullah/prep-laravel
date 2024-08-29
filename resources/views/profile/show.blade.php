@extends('layout.app1')

@section('title', 'Profile')

@section('styles')
<style>
    .profile-container {
        max-width: 600px;
        margin: auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .profile-details {
        margin-bottom: 15px;
    }
    .profile-details label {
        font-weight: bold;
    }
</style>
@endsection

@section('content')
<div class="profile-container">
    <h2>User Profile</h2>

    <div class="profile-details">
        <label>Username:</label>
        <span>{{ $user['username'] }}</span>
    </div>

    <div class="profile-details">
        <label>Email:</label>
        <span>{{ $user['email'] }}</span>
    </div>

    <div class="profile-details">
        <label>Location:</label>
        <span>{{ $user['location'] ?? 'N/A' }}</span>
    </div>

    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
</div>
@endsection
