@extends('layout.app1')

@section('title', 'Edit Profile')

@section('styles')
<style>
    .edit-profile-container {
        max-width: 600px;
        margin: auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .edit-profile-form input[type="text"],
    .edit-profile-form input[type="email"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .edit-profile-form button {
        background-color: #5995fd;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }
    .edit-profile-form button:hover {
        background-color: #4d84e2;
    }
</style>
@endsection

@section('content')
<div class="edit-profile-container">
    <h2>Edit Profile</h2>

    <form action="{{ route('profile.update') }}" method="POST" class="edit-profile-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="{{ $user['username'] }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $user['email'] }}" required>
        </div>

        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" value="{{ $user['location'] ?? '' }}">
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection
