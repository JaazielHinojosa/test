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
                        <div class="m-portlet">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Habitación iluminada
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <!--begin::Section-->
                                <div class="m-section">
                                    <div class="m-section__content">
                                        <table class="table table-bordered m-table m-table">
                                            <thead>
                                            @foreach($matrix as $indexCols => $cols)
                                                <tbody>
                                                <tr>
                                                    @foreach($cols as $indexRaws => $value)
                                                        @if($value == 1){{--ES PARED--}}
                                                            <td style="background: black; color: white">{{$value}}</td>
                                                        @endif
                                                        @if($value == 2){{--ES UN FOCO--}}
                                                            <td style="background: yellow; color: black">{{$value}}</td>
                                                        @endif
                                                        @if($value == 3){{--ESTA ILUMINADO--}}
                                                            <td style="background: lightgoldenrodyellow; color: black">{{$value}}</td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                                </tbody>
                                            @endforeach
                                        </table>
                                        <div class="m-section__content">
                                            <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
                                                <div class="m-demo__preview m-demo__preview--badge">
                                                    <span class="m-badge m-badge m-badge--wide" style="background: black; color: white">Pared</span>
                                                    <span class="m-badge m-badge m-badge--wide" style="background: yellow; color: black">Foco</span>
                                                    <span class="m-badge m-badge m-badge--wide" style="background: lightgoldenrodyellow; color: black">Espacio iluminado</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end::Section-->
                            </div>

                            <!--end::Form-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
