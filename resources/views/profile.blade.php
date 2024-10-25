@extends('layouts.app')

@section('title')
Profil
@endsection

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Profil</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Profil</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column">
                        <h2>{{Auth::user()->name}}</h2>
                    </div>
                    <div class="profile-overview mx-3" id="profile-overview">
                        <h5 class="card-title" style="font-weight: 600;">Detail Profil</h5>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 label ">Nama</div>
                            <div class="col-lg-8 col-md-8">{{Auth::user()->name}}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 label">Email</div>
                            <div class="col-lg-8 col-md-8">{{Auth::user()->email}}</div>
                        </div>

                    </div>
                    <div class="mb-2 text-center">
                        <x-primary-button class="w-full flex justify-center items-center" style="width: 200px;" data-bs-toggle="modal"
                            data-bs-target="#editprofil"
                            data-id="{{ Auth::user()->id }}"
                            data-name="{{ Auth::user()->name }}"
                            data-email="{{ Auth::user()->email }}">
                            {{ __('Edit Profil') }}
                        </x-primary-button>
                    </div>


                </div>

                <!-- card editGuru modal -->
                <div class="modal fade" id="editprofil" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 mx-50 pb-5">
                                <h3 class="text-center mb-1" id="addNewCardTitle">Edit Data</h3>
                                <!-- form -->
                                <form class="form row gy-1 gx-2 mt-75" method="POST" action="">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="{{auth::user()->id}}" />
                                    <div class="col-12">
                                        <label class="form-label" for="name">Nama</label>
                                        <div class="input-group input-group-merge">
                                            <input id="name" name="name" class="form-control" type="text" required value="{{auth::user()->name}}" />
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label" for="email">Email</label>
                                        <div class="input-group input-group-merge">
                                            <input id="email" name="email" class="form-control" type="text" required value="{{auth::user()->username}}" />
                                        </div>
                                    </div>

                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary me-1 mt-1">Submit</button>
                                        <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end card modal -->

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-2">
                        <h5 class="card-title mx-2" style="font-weight: 600;">Formulir Ubah Password</h5>
                        <!-- Bordered Tabs -->
                        <div class="password-detail mx-2" id="profile-change-password">
                            <!-- Change Password Form -->
                            <form method="POST" action="">
                                @csrf
                                @method('put')
                                <div class="row mb-3">
                                    <label for="old_password" class="col-md-4 col-lg-3 col-form-label">Password Lama</label>
                                    <div class="col-md-8 col-lg-9">
                                        <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <label for="newPassword" class="col-md-4 col-lg-3 col-form- label">Password Baru</label>
                                    <div class="col-md-8 col-lg-9">
                                        <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Konfirmasi Password Baru</label>
                                    <div class="col-md-8 col-lg-9">
                                        <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="text-center">
                                    <x-primary-button class="w-full flex justify-center items-center" style="width: 200px;">
                                        {{ __('Ubah Password') }}
                                    </x-primary-button>
                                </div>
                            </form><!-- End Change Password Form -->
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->



<script>
    $('#editprofil').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button yang memicu modal
        var id = button.data('id'); // Ambil nilai dari data-id
        var name = button.data('name'); // Ambil nilai dari data-name
        var email = button.data('email'); // Ambil nilai dari data-email

        var modal = $(this);
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #email').val(email);
    });
</script>

@endsection