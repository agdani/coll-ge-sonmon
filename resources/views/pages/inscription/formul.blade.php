@extends('main.admin_layout')
@section()

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Mon profil /</span> Compte</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h4 class="card-header">Détails du profil</h4>
                <!-- Account -->
                <div class="row justify-content-center">
                    <div class="col-lg-2 col-12">
                        <div class="card-body mt-5">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="{{ session()->get('data')->admin_img }}" alt="user-avatar"
                                    class="d-block w-px-120 h-px-120 rounded" id="uploadedAvatar" />
                                <div class="button-wrapper">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10 col-12">
                        <div class="card-body pt-2 mt-1">
                            <div id="formAccountSettings">
                                <div class="row mt-2 gy-4">
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" placeholder="Votre nom" id="firstName" disabled value="{{  session()->get('data')->fname }}"
                                                />
                                            <label for="firstName">N</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" placeholder="Votre prénom" disabled value="{{  session()->get('data')->lname }}" id="lastName" />
                                            <label for="lastName">Nom et prenom</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" placeholder="Votre prénom" disabled value="{{  session()->get('data')->lname }}" id="lastName" />
                                            <label for="lastName">Reliquat</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" placeholder="Votre prénom" disabled value="{{  session()->get('data')->lname }}" id="lastName" />
                                            <label for="lastName">Scolarite/Annee</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" placeholder="Votre prénom" disabled value="{{  session()->get('data')->lname }}" id="lastName" />
                                            <label for="lastName">Scolarite Totale</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" placeholder="Votre prénom" disabled value="{{  session()->get('data')->lname }}" id="lastName" />
                                            <label for="lastName">1er versement</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" placeholder="Votre prénom" disabled value="{{  session()->get('data')->lname }}" id="lastName" />
                                            <label for="lastName">Prénoms</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" placeholder="Votre prénom" disabled value="{{  session()->get('data')->lname }}" id="lastName" />
                                            <label for="lastName">Prénoms</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" placeholder="Votre prénom" disabled value="{{  session()->get('data')->lname }}" id="lastName" />
                                            <label for="lastName">Prénoms</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" placeholder="Votre prénom" disabled value="{{  session()->get('data')->lname }}" id="lastName" />
                                            <label for="lastName">Prénoms</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" placeholder="Votre prénom" disabled value="{{  session()->get('data')->lname }}" id="lastName" />
                                            <label for="lastName">Prénoms</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" placeholder="Votre prénom" disabled value="{{  session()->get('data')->lname }}" id="lastName" />
                                            <label for="lastName">Prénoms</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" placeholder="Votre prénom" disabled value="{{  session()->get('data')->lname }}" id="lastName" />
                                            <label for="lastName">Prénoms</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" placeholder="Votre prénom" disabled value="{{  session()->get('data')->lname }}" id="lastName" />
                                            <label for="lastName">Prénoms</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" placeholder="Votre prénom" disabled value="{{  session()->get('data')->lname }}" id="lastName" />
                                            <label for="lastName">Prénoms</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" placeholder="Votre prénom" disabled value="{{  session()->get('data')->lname }}" id="lastName" />
                                            <label for="lastName">Prénoms</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
</div>
@endsection
