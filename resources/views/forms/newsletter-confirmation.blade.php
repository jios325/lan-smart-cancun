@extends('layouts.main', ['classMenu' => 'intern__nav'])
@section('content')
    <div class="main-section main-section--newsletter">
        <div class="divisor divisor-intern"></div>
        <div class="main-section--newsletter__form">
                <form action="#" id="form-contacto-subcripcion" method="post" class="form">
                    <div class="form-contacto" style="padding-top:40px;padding-bottom:40px;">
                        <div class="container-fluid wrap-container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8 center-xs">
                                    <div class="row middle-sm">
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="{{$user->id}}" id="idSlug">
                                                <label for="" class="form__label required">{{__('contacto.nombre')}}:</label>
                                                <input type="text" name="nombre" class="form-control--events" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="apellido" class="form__label required">{{__('contacto.apellido')}}:</label>
                                                <input type="text" name="apellido" class="form-control--events" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="" class="form__label required">{{__('contacto.telephone')}}:</label>
                                                <input type="text" name="tel" class="form-control--events" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="" class="form__label required">Email:</label>
                                                <input type="text" name="email" class="form-control--events" value="{{$user->email}}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label for="" class="form__label required">{{__('contacto.direccion')}}:</label>
                                                <input type="text" name="direccion" id="" class="form-control--events" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                          <div class="form-group">
                                                <div class="checkbox">
                                                    <label for="condiciones-de-uso">
                                                        <input type="checkbox" id="condiciones-de-uso" name="condiciones-de-uso">
                                                        <a href="#condiciones-de-uso-modal" class="modal--popup text-underline">{{__('newsletter.acepto_los')}}</a>
                                                    </label>
                                                    <div id="condiciones-de-uso-modal" class="white-popup white-popup-xs mfp-hide">
                                                        <h3 class="white-popup__title pb-20">{{__('contacto.politicas')}} | {{$hotel->nombre_en}}</h3>
                                                        <div class="white-popup__body">
                                                            {{__('contacto.politicas_msj')}}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                          <div class="form-group">
                                              <input type="submit" class="btn btn-reserva" value="{{__('contacto.enviar')}}" disabled="true">
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
        </div>
    </div>
@endsection
