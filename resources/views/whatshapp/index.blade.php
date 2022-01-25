@extends('main')

@section('css')

@endsection

@section('content')
    <div class="container app">
        <div class="row app-one">
            <div class="col-sm-4 side">
                <div class="side-one">
                    <div class="row heading">
                        <div class="col-3 heading-avatar">
                            <div class="heading-avatar-icon">
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png">
                            </div>
                        </div>
                        <div class="col-9">
                            <span class="user-login">{{ Auth::user()->name }}</span>
                            <a href="{{ route('listContact') }}">
                                <i class="fa fa-address-book"></i>
                            </a>
                        </div>
                        {{-- <div class="col-sm-1 col-xs-1  heading-dot  pull-right">
                            <i class="fa fa-ellipsis-v fa-2x  pull-right" aria-hidden="true"></i>
                        </div>
                        <div class="col-sm-2 col-xs-2 heading-compose  pull-right">
                            <i class="fa fa-comments fa-2x  pull-right" aria-hidden="true"></i>
                        </div> --}}
                    </div>

                    <div class="row searchBox">
                        <div class="col-sm-12 searchBox-inner">
                            <div class="form-group has-feedback">
                                <input id="searchText" type="text" onkeyup="searching()" class="form-control" name="searchText" placeholder="Search">
                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                            </div>
                        </div>
                    </div>

                    <div class="sideBar scroll">
                        <div class="contact">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="row heading">
                    <div class="col-sm-2 col-md-1 col-xs-3 heading-avatar heading-chat-photo">
                        <div class="heading-avatar-icon">
                            {{-- <img src="https://bootdey.com/img/Content/avatar/avatar6.png"> --}}
                            <div class="avatar-sm float-left mr-2">
                                {{-- <img src="{{ 'https://ui-avatars.com/api/?name='.$user->name }}" alt="Avatar" class="avatar-img rounded-circle heading-photo"> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8 col-xs-7 heading-name">
                        {{-- <a class="heading-name-meta">John Doe</a> --}}
                        <span class="heading-name-meta"></span>
                        <span class="heading-online">Online</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="fa fa-ellipsis-v fa-2x pull-right"></button>
                    </form>
                </div>
                <div class="row message scroll" id="conversation">
                    <div class="chatting">
                        <center>
                            <i class="fa fa-whatsapp" aria-hidden="true"></i>
                        </center>
                    </div>
                </div>
                <div class="row reply">
                    <div class="col-sm-1 col-xs-1 reply-emojis">
                        <i class="fa fa-smile-o fa-2x"></i>
                    </div>
                    <div class="col-sm-9 col-xs-9 reply-main">
                        <textarea class="form-control" placeholder="message" rows="1" name="comment" id="comment"></textarea>
                    </div>
                    <div class="col-sm-1 col-xs-1 reply-recording">
                        <i class="fa fa-microphone fa-2x" aria-hidden="true"></i>
                    </div>
                    <div class="col-sm-1 col-xs-1 reply-send">
                        <i class="fa fa-send fa-2x" id="send" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        let selectedUser = 0;
        let message = null;
        let topic = null;
        let allusers = @json( $users );
        let txtValue = null;
        let filter;
        let namauser;

        let audio = document.getElementById("myAudio");

        function playAudio() {
            audio.play();
        }

        $.ajax({
            type: 'GET',
            url: "{{ route('contact') }}",
            data: {
                allusers: allusers
            },
            success: function(data) {
                $('.sideBar').find('.contact').html(data);
            }
        });

        function reload(topic, message, selectedUser) {
            $.ajax({
                type: 'GET',
                url: "{{ url('whatshapp') }}" + '/' + selectedUser,
                data: {
                    selectedUser: selectedUser,
                    topic: topic
                },
                datatype: 'html',
                success: function(data) {
                    $('#conversation').find('.chatting').html(data);
                }
            });
            console.log(topic);
            if (message !== null && topic === '/wa/'+@json( Auth::user()->email )) {
                playAudio();
                toastr.info("Pesan Baru");
            }
        }

        window.mqttOnMessage = (topic, message, mqttUserKey) => {
            console.log("reload");
            reload(topic, message, mqttUserKey);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            $(document).on('click', '#select_user', function() {
                selectedUser = $(this).data('id');
                topic = '/wa/' + $(this).attr('data-email');
                // console.log(topic);
                // return;
                window.mqttUserKey = selectedUser;
                console.log(topic);
                reload(topic, message, selectedUser);
            });

            $(document).on('click', '#send', function() {
                if ( $('#comment').val() ) {
                    let comment = $('#comment').val();
                    $('#comment').val('');
                    let userLogin = @json( Auth::user()->id );

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('whatshapp.store') }}",
                        data: {
                            userLogin: userLogin,
                            comment: comment,
                            selectedUser: selectedUser,
                            topic: topic
                        },
                        datatype: 'html',
                        success: function(data) {
                            $('#conversation').find('.chatting').html(data);
                        }
                    });
                }
            });

            $(document).on('click', '#logout', function() {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('logout') }}",
                });
            });

            $(document).on('click', '.chat-user', function() {
                $('.heading-name-meta').empty();
                let nameUser = $(this).find('.name-meta').text();
                console.log(nameUser);
                $('.heading-name-meta').html(nameUser);
                let photo = $(this).find('.avatar-img').attr('src');
                let save = $('.heading-chat-photo').find('.heading-photo').attr('src', photo);
            });

            $(".heading-compose").click(function() {
                $(".side-two").css({
                    "left": "0"
                });
            });

            $(".newMessage-back").click(function() {
                $(".side-two").css({
                    "left": "-100%"
                });
            });
        });

        // function searching() {
        //     for (let i = 0; i < allusers.length; i++) {
        //         let sidebar = document.getElementsByClassName('sideBar')[0];
        //         namauser = sidebar.getElementsByTagName('div');
        //         // console.log();
        //         // return;

        //         let search = document.getElementById('searchText');
        //         filter = search.value.toUpperCase();
        //         allusers[i].name = search.value;
        //         // console.log(allusers[i].name);
        //         // return;
        //         let selectuser_id = document.getElementById('select_user');
        //         // console.log(selectuser);
        //         // return;
        //         let selectuser = selectuser_id.getElementsByClassName('sideBar-main')[0];
        //         selectuser = selectuser.getElementsByClassName('row')[0];
        //         selectuser = selectuser.getElementsByClassName('sideBar-name')[0];
        //         selectuser = selectuser.getElementsByClassName('name-meta')[0];
        //         selectuser.innerText = search.value;
        //         txtValue = selectuser.innerText;
        //         console.log(txtValue.toUpperCase().indexOf(filter));
        //         if (txtValue.toUpperCase().indexOf(filter) > -1) {
        //             namauser[i].style.display = "none";
        //         } else {
        //             namauser[i].style.display = "";
        //         }
        //         // console.log(allusers[i].getElementById('user'));
        //     }
        // }
    </script>
@endsection
