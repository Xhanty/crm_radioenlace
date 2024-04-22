@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Chats</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->
        <div class="row row-sm mb-4">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-12 col-xxl-4 col-lg-12">
                        <div class="card">
                            <div class="main-content-app">
                                <div class="main-content-left main-content-left-chat overflow-hidden">
                                    <nav class="nav main-nav-line main-nav-line-chat">
                                        <a class="nav-link active" data-bs-toggle="tab" href="javascript:void(0);">Chats</a>
                                        <a class="nav-link" data-bs-toggle="tab" href="javascript:void(0);">Grupos</a>
                                        <a class="nav-link" data-bs-toggle="tab" href="javascript:void(0);">Llamadas</a>
                                    </nav>
                                    <div class="main-chat-list" id="ChatList">
                                        <div class="media new">
                                            <div class="main-img-user online">
                                                <img alt=""
                                                    src="{{ asset('images/empleados/' . session('user_img')) }}">
                                                <span>2</span>
                                            </div>
                                            <div class="media-body">
                                                <div class="media-contact-name">
                                                    <span>Socrates Itumay</span> <span>2 hours</span>
                                                </div>
                                                <p>Nam quam nunc, blandit vel aecenas et ante tincid</p>
                                            </div>
                                        </div>
                                        <div class="media new">
                                            <div class="main-img-user">
                                                <img alt=""
                                                    src="{{ asset('images/empleados/' . session('user_img')) }}">
                                                <span>1</span>
                                            </div>
                                            <div class="media-body">
                                                <div class="media-contact-name">
                                                    <span>Dexter dela Cruz</span> <span>3 hours</span>
                                                </div>
                                                <p>Maec enas tempus, tellus eget con dime ntum rhoncus, sem quam</p>
                                            </div>
                                        </div>
                                        <div class="media selected">
                                            <div class="main-img-user online"><img alt=""
                                                    src="{{ asset('images/empleados/' . session('user_img')) }}">
                                            </div>
                                            <div class="media-body">
                                                <div class="media-contact-name">
                                                    <span>Reynante Labares</span> <span>10 hours</span>
                                                </div>
                                                <p>Nam quam nunc, bl ndit vel aecenas et ante tincid</p>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="main-img-user"><img alt=""
                                                    src="{{ asset('images/empleados/' . session('user_img')) }}">
                                            </div>
                                            <div class="media-body">
                                                <div class="media-contact-name">
                                                    <span>Joyce Chua</span> <span>2 days</span>
                                                </div>
                                                <p>Ma ecenas tempus, tellus eget con dimen tum rhoncus, sem quam</p>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="main-img-user"><img alt=""
                                                    src="{{ asset('images/empleados/' . session('user_img')) }}">
                                            </div>
                                            <div class="media-body">
                                                <div class="media-contact-name">
                                                    <span>Rolando Paloso</span> <span>2 days</span>
                                                </div>
                                                <p>Nam quam nunc, blandit vel aecenas et ante tincid</p>
                                            </div>
                                        </div>
                                    </div><!-- main-chat-list -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl-12 col-xxl-8">
                        <div class="card">
                            <div class="main-content-app">
                                <a class="main-header-arrow" href="javascript:void(0);" id="ChatBodyHide"><i
                                        class="icon ion-md-arrow-back"></i></a>
                                <div class="main-content-body main-content-body-chat">
                                    <div class="main-chat-header">
                                        <div class="main-img-user"><img alt=""
                                                src="{{ asset('images/empleados/' . session('user_img')) }}">
                                        </div>
                                        <div class="main-chat-msg-name">
                                            <h6>Reynante Labares</h6><small>Last seen: 2 minutes ago</small>
                                        </div>
                                        <nav class="nav">
                                            <!--<a class="nav-link" href="javascript:void(0);"><i
                                                    class="icon ion-md-more"></i></a>
                                            <a class="nav-link" data-bs-toggle="tooltip" href="javascript:void(0);"
                                                title="Call"><i class="fe fe-star"></i></a>
                                            <a class="nav-link" data-bs-toggle="tooltip" href="javascript:void(0);"
                                                title="Trash"><i class="fe fe-trash"></i></a>
                                            <a class="nav-link" data-bs-toggle="tooltip" href="javascript:void(0);"
                                                title="View Info"><i class="fe fe-alert-circle"></i></a>-->
                                        </nav>
                                    </div><!-- main-chat-header -->
                                    <div class="main-chat-body" id="ChatBody">
                                        <div class="content-inner">
                                            <label class="main-chat-time"><span>3 days ago</span></label>
                                            <div class="media flex-row-reverse">
                                                <div class="main-img-user online"><img alt=""
                                                        src="{{ asset('images/empleados/' . session('user_img')) }}">
                                                </div>
                                                <div class="media-body">
                                                    <div class="main-msg-wrapper right">
                                                        Nulla consequat massa quis enim. Donec pede justo, fringilla vel...
                                                    </div>
                                                    <div class="main-msg-wrapper right">
                                                        rhoncus ut, imperdiet a, venenatis vitae, justo...
                                                    </div>
                                                    <div class=" p-0"><img alt=""
                                                            class="wd-100 ht-100 rounded-5"
                                                            src="{{ asset('images/empleados/' . session('user_img')) }}">
                                                    </div>
                                                    <div>
                                                        <span>9:48 am</span> <a href="javascript:void(0);"><i
                                                                class="icon ion-android-more-horizontal"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="main-img-user online"><img alt=""
                                                        src="{{ asset('images/empleados/' . session('user_img')) }}">
                                                </div>
                                                <div class="media-body">
                                                    <div class="main-msg-wrapper left">
                                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean
                                                        commodo ligula eget dolor.
                                                    </div>
                                                    <div>
                                                        <span>9:32 am</span> <a href="javascript:void(0);"><i
                                                                class="icon ion-android-more-horizontal"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media flex-row-reverse">
                                                <div class="main-img-user online"><img alt=""
                                                        src="{{ asset('images/empleados/' . session('user_img')) }}">
                                                </div>
                                                <div class="media-body">
                                                    <div class="main-msg-wrapper right">
                                                        Nullam dictum felis eu pede mollis pretium
                                                    </div>
                                                    <div>
                                                        <span>11:22 am</span> <a href="javascript:void(0);"><i
                                                                class="icon ion-android-more-horizontal"></i></a>
                                                    </div>
                                                </div>
                                            </div><label class="main-chat-time"><span>Yesterday</span></label>
                                            <div class="media">
                                                <div class="main-img-user online"><img alt=""
                                                        src="{{ asset('images/empleados/' . session('user_img')) }}">
                                                </div>
                                                <div class="media-body">
                                                    <div class="main-msg-wrapper left">
                                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean
                                                        commodo ligula eget dolor.
                                                    </div>
                                                    <div>
                                                        <span>9:32 am</span> <a href="javascript:void(0);"><i
                                                                class="icon ion-android-more-horizontal"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media flex-row-reverse">
                                                <div class="main-img-user online"><img alt=""
                                                        src="{{ asset('images/empleados/' . session('user_img')) }}">
                                                </div>
                                                <div class="media-body">
                                                    <div class="main-msg-wrapper right">
                                                        Donec quam felis, ultricies nec, pellentesque euerdiet a, venenatis
                                                        vitae, justo.
                                                    </div>
                                                    <div class="main-msg-wrapper right">
                                                        Nullam dictum felis eu pede mollis pretium
                                                    </div>
                                                    <div>
                                                        <span>9:48 am</span> <a href="javascript:void(0);"><i
                                                                class="icon ion-android-more-horizontal"></i></a>
                                                    </div>
                                                </div>
                                            </div><label class="main-chat-time"><span>Today</span></label>
                                            <div class="media">
                                                <div class="main-img-user online"><img alt=""
                                                        src="{{ asset('images/empleados/' . session('user_img')) }}">
                                                </div>
                                                <div class="media-body">
                                                    <div class="main-msg-wrapper left">
                                                        Maecenas tempus, tellus eget condimentum rhoncus
                                                    </div>
                                                    <div class="main-msg-wrapper left">
                                                        Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
                                                        Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut
                                                        libero venenatis faucibus.
                                                    </div>
                                                    <div>
                                                        <span>10:12 am</span> <a href="javascript:void(0);"><i
                                                                class="icon ion-android-more-horizontal"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media flex-row-reverse">
                                                <div class="main-img-user online"><img alt=""
                                                        src="{{ asset('images/empleados/' . session('user_img')) }}">
                                                </div>
                                                <div class="media-body">
                                                    <div class="main-msg-wrapper right">
                                                        Maecenas tempus, tellus eget condimentum rhoncus
                                                    </div>
                                                    <div class="main-msg-wrapper right">
                                                        Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.
                                                        Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut
                                                        libero venenatis faucibus.
                                                    </div>
                                                    <div>
                                                        <span>09:40 am</span> <a href="javascript:void(0);"><i
                                                                class="icon ion-android-more-horizontal"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-chat-footer">
                                        <nav class="nav">
                                        </nav><input class="form-control" placeholder="Type your message here..."
                                            type="text">
                                        <a class="nav-link me-2" data-bs-toggle="tooltip" href="javascript:void(0);"
                                            title="Add Emoticons"><i class="fe fe-paperclip"></i></a>
                                        <a class="main-msg-send" href="javascript:void(0);"><i
                                                class="fe fe-send"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!--<script>
        $(function() {
            'use strict'
            $('#chatActiveContacts').lightSlider({
                autoWidth: true,
                controls: false,
                pager: false,
                slideMargin: 12
            });
            if (window.matchMedia('(min-width: 992px)').matches) {
                new PerfectScrollbar('#ChatList', {
                    suppressScrollX: true
                });
                const ChatBody = new PerfectScrollbar('#ChatBody', {
                    suppressScrollX: true
                });
                const Chatmain = new PerfectScrollbar('.chat-main', {
                    useBothWheelAxes: true,
                    suppressScrollX: true,
                });
                $('#ChatBody').scrollTop($('#ChatBody').prop('scrollHeight'));
            }
            $('.main-chat-list .media').on('click touch', function() {
                $(this).addClass('selected').removeClass('new');
                $(this).siblings().removeClass('selected');
                if (window.matchMedia('(max-width: 991px)').matches) {
                    $('body').addClass('main-content-body-show');
                    $('html body').scrollTop($('html body').prop('scrollHeight'));
                }
            });
            $('[data-bs-toggle="tooltip"]').tooltip();
            $('#ChatBodyHide').on('click touch', function(e) {
                e.preventDefault();
                $('body').removeClass('main-content-body-show');
            })
        });
    </script>-->
    <script>
        $(document).ready(function() {
            var usuarios = @json($usuarios);

            localStorage.setItem('usuarios', JSON.stringify(usuarios));
        });
    </script>
    <!--<script src="{{ asset('assets/js/app/chat.js') }}"></script>-->
@endsection
