@extends('layouts.app')
@section('script')
    <?php
    $rand = 1;//rand();
    ?>
    <script src={{asset('js/users.js?rand='.$rand)}} type="text/javascript"></script>
@endsection
@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title ">Habitación</h3>
                </div>
            </div>
        </div>

        <!-- END: Subheader -->
        <div class="m-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="m-portlet m-portlet--mobile">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Iluminar
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            {!! Form::open(['id' => 'algorithm', 'class' => 'm-form m-form--fit m-form--label-align-right form-horizontal users-forms', 'role' => 'form', 'route' => 'room.algorithm']) !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row tool" data-tool="usuarios" data-toolsub="algorithm">
                                    <div class="col-sm-7">
                                        <input id="algorithm" type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom" value="Iluminar habitación">
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
