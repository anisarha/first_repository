@extends('layouts.admin')
@section('content')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }

        .profile-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-container img {
            margin-right: 20px;
        }

        .form-container {
            display: flex;
            justify-content: space-between;
        }

        .form-container .form-group {
            width: 48%;
        }
    </style>
    </head>
    <div class="col-12">
        <div class="container mt-5">
            <div class="profile-container">
                <img alt="Profile picture of Irga Ramadhan Putra" class="profile-img" height="100"
                    src="{{ asset('backend/dist/images/profil_test.png') }}" width="100" />

                    <h2>
                        {{ $user->name }}
                    </h2>
            </div>
            <div class="form-container">
                <div class="form-group">
                    <label for="namaKandidat">
                        Nama Kandidat
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-user">
                            </i>
                        </span>
                        <input class="form-control" id="namaKandidat" readonly="" type="text" value="{{ $user->name }}" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="posisiKandidat">
                        Posisi Kandidat
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-code">
                            </i>
                        </span>
                        <input class="form-control" id="posisiKandidat" readonly="" type="text" value="{{ $user->position }}" />
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection('conten')
