@extends('main.admin_layout')
@section('title')
Faire une inscription
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="app-kanban">
        <!-- Add new board -->
        <div class="row">
            <div class="col-12">
                <h6 class="text-muted">
                    Faire une inscription
                    <i class="menu-icon tf-icons ms-2 mdi mdi-account-multiple-plus"></i>
                </h6>
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3 nav-fill" role="tablist" id="steppers">
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link waves-effect waves-light active" role="tab"
                                data-bs-toggle="tab" data-bs-target="#navs-pills-justified-home"
                                aria-controls="navs-pills-justified-home" aria-selected="true">
                                <i class="tf-icons mdi mdi-book-information-variant me-1"></i>
                                Étape 1
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link waves-effect waves-light" role="tab"
                                data-bs-toggle="tab" data-bs-target="#navs-pills-justified-profile"
                                aria-controls="navs-pills-justified-profile" aria-selected="false" tabindex="-1">
                                <i class="menu-icon tf-icons ms-2 mdi mdi-account-multiple-plus"></i>
                                Étape 2
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link waves-effect waves-light" role="tab"
                                data-bs-toggle="tab" data-bs-target="#navs-pills-justified-messages"
                                aria-controls="navs-pills-justified-messages" aria-selected="false" tabindex="-1">
                                <i class="tf-icons mdi mdi-message-text-outline me-1"></i>
                                Étape 3
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="navs-pills-justified-home" role="tabpanel">
                            <div class="row justify-content-center">
                                @foreach ($liste_scolarite as $item)
                                    <div class="col-lg-4 col-md-6 col-12" id="scolarite-bloc">
                                        <div class="card text-center m-2">
                                            <div class="card-body">
                                                <h5 class="card-title">Je fais mon inscription</h5>
                                                <p class="card-text"><i class="mdi mdi-book-open-page-variant fs-1"></i></p>
                                                <button type="button"
                                                onclick="toggleActive(event); getValue('{{ $item }}')"
                                                 class="btn border btn-toggle btn-label-primary waves-effect">
                                                    <span class="tf-icons mdi d-none mdi-checkbox-marked-circle-outline me-3"></span>
                                                    {{ $item->niveau_etude }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-lg-8 col-12 d-none" id="info-bloc">
                                    <div class="card m-2">
                                        <div class="card-body">
                                            <h2 class="text-center fw-bolder" id="show-niv"></h2>
                                            <hr>
                                            <div class="row justify-content-center">
                                                <div class="col-lg-9 col-12">
                                                    <h5 class="ms-4 mb-3">Scolarité:<span class="ms-3 fw-bolder" id="scolarite"></span></h5>
                                                    <h5 class="ms-4 mb-3">Année scolaire:<span class="ms-3 fw-bolder" id="school_year"></span></h5>
                                                    <h5 class="ms-4 mb-3">Collège:<span class="ms-3 fw-bolder" id="cll"></span></h5>
                                                </div>
                                                <div class="col-lg-3 col-12 text-end">
                                                    <span class="tf-icons mdi mdi-book-open-page-variant text-green me-3 fs-big"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12 d-none" id="info-btn">
                                    <div class="d-flex justify-content-center">
                                        <button type="button" onclick="removeActive()" class="btn m-2 border btn-danger waves-effect">
                                            <span class="tf-icons mdi mdi-close-box-multiple me-3"></span>
                                            Changer
                                        </button>
                                        <button type="button" onclick="goToNextStep()" class="btn m-2 border btn-primary waves-effect">
                                            <span class="tf-icons mdi mdi-check-underline-circle me-3"></span>
                                            Confirmer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                            <p>
                                Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice
                                cream. Gummies
                                halvah
                                tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream cheesecake
                                fruitcake.
                            </p>
                            <p class="mb-0">
                                Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu
                                halvah cotton candy
                                liquorice caramels.
                            </p>
                        </div>
                        <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                            <p>
                                Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon
                                gummies cupcake gummi
                                bears
                                cake chocolate.
                            </p>
                            <p class="mb-0">
                                Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake.
                                Sweet roll icing
                                sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly
                                jelly-o tart brownie
                                jelly.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .fs-big{
        font-size: 5.875rem !important;
    }
    .text-green{
        color: #249441 !important;
    }
</style>

<script>

    function getValue(n){
        let convert = JSON.parse(n);
        document.querySelector('#show-niv').innerHTML = convert.niveau_etude;
        document.querySelector('#scolarite').innerHTML = convert.price+' '+' F CFA';
        document.querySelector('#school_year').innerHTML = convert.school_year_start+'-'+convert.school_year_end;
        document.querySelector('#cll').innerHTML = 'Collège somon de konahiri';
    }

    function removeActive(){
        let buttonList = document.querySelectorAll(".btn-toggle");
        let info_bloc = document.querySelector('#info-bloc');
        let info_btn = document.querySelector('#info-btn');
        let scolarite_bloc = document.querySelectorAll('#scolarite-bloc');
        let icon_show = document.querySelectorAll('.btn-toggle .tf-icons');

        info_btn.classList.add('d-none');
        info_bloc.classList.add('d-none');

        buttonList.forEach((el) => {
            el.classList.remove('disabled');
            el.classList.add('btn-label-primary');
            el.classList.remove('btn-primary');
        });

        scolarite_bloc.forEach((el) => {
            el.classList.remove('d-none');
        });

        icon_show.forEach((el) => {
            el.classList.add('d-none');
        });

    }

    function toggleActive(event) {
        let target = event.target || event.srcElement;
        let buttonList = document.querySelectorAll(".btn-toggle");
        let icon_show = document.querySelector('.btn-toggle .tf-icons');

        let info_bloc = document.querySelector('#info-bloc');
        let info_btn = document.querySelector('#info-btn');
        let scolarite_bloc = document.querySelectorAll('#scolarite-bloc');
        // console.log(target); return
        buttonList.forEach(function(button) {

            info_bloc.classList.remove('d-none');
            info_btn.classList.remove('d-none');

                if (button === target && !button.classList.contains("btn-primary")) {

                    button.id = "on";
                    let scolarite_target = document.querySelector("#on");
                    let icon_target = document.querySelector("#on .tf-icons");
                    scolarite_target.classList.remove('btn-label-primary');
                    scolarite_target.classList.add('btn-primary');
                    scolarite_target.classList.add('disabled');
                    icon_target.classList.toggle('d-none');

                }else{

                    scolarite_bloc.forEach((elt) => {
                        if (elt === target && !elt.classList.contains("btn-primary")) {
                            elt.classList.remove('d-none');
                        }else{
                            elt.classList.add('d-none');
                        }
                    });

                    button.id = "off";
                    setTimeout(() => {
                        let scolarite_no_target = document.querySelectorAll("#off");
                        let icon_no_target = document.querySelectorAll("#off .tf-icons");
                        scolarite_no_target.forEach(element => {
                            element.classList.add('btn-label-primary');
                            element.classList.remove('btn-primary');
                        });
                        icon_no_target.forEach(element => {
                            element.classList.add('d-none');
                        });
                    }, 200);

                }
            }
        )
    }

    function goToNextStep(){
        let add_attr = document.querySelectorAll('#steppers .nav-item .waves-light')
        let active_nav_item = document.querySelector('#steppers .nav-item .active')
        let active_nav_item = document.querySelector('#steppers .nav-item .active')

        let len = add_attr.length;

        for(let i = 0; i < add_attr.length;i++)
        {
            if(add_attr[i] == active_nav_item)
            {
                let _next = add_attr[i + 1];
                let no_target = add_attr.findIndex((elts) => elts.ariaSelected == "true");
                _next.ariaSelected = "true";
                _next.removeAttribute('tabindex');
                _next.classList.add('active');

                no_target.ariaSelected = "false";
                no_target.setAttribute('tabindex', -1);
                no_target.classList.remove('active');
            }
            if(!add_attr[i].classList.contains("active")){

                add_attr[i].ariaSelected = "false";
                add_attr[i].setAttribute('tabindex', -1);
                add_attr[i].classList.remove('active');
            }
        }
    }
</script>
@endsection

