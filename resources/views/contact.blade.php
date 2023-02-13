@extends('layouts.front')
@section('content')
<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ asset('/') }}"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contactez-nous</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- google map start -->

    <!-- google map end -->

    <!-- contact area start -->
    <div class="contact-area section-padding pt-0 mt-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6">
                    <div class="contact-message">
                        <h4 class="contact-title">Contactez-nous</h4>
                        <p>N'hésitez pas à nous contacter pour toute question ou demande, nous sommes là pour vous aider.</p>
                        <form id="contact-form" action="{{ asset('/contact') }}" method="post" class="contact-form">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input name="name" placeholder="Nom complet *" type="text" required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input name="phone" placeholder="Téléphone *" type="text" required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input name="email" placeholder="Email *" type="text" required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input name="subject" placeholder="Sujet *" type="text">
                                </div>
                                <div class="col-12">
                                    <div class="contact2-textarea text-center">
                                        <textarea placeholder="Message *" name="message" class="form-control2" required=""></textarea>
                                    </div>
                                    <div id="show_contact_msg" >
                                    </div>
                                    <div class="contact-btn">
                                        <button class="btn btn-sqr" >Envoyer</button>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-center">
                                    <p class="form-messege"></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">

                </div>
            </div>
        </div>
    </div>
    <!-- contact area end -->
</main>

@endsection

@push('contact-scripts')
<script>
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   $("#contact-form").on("submit", function (e)
    {
        $('#show_contact_msg').html('<div >En cours....</div>');
        var name = $('#name').val();
        var email = $('#email').val();
        var message = $('#message').val();
        var subject = $('#subject').val();
        var formURL = $(this).attr("action");
        var data = {
           name: name,
            email: email,
            subject:subject,
            message: message
        };
        $.ajax(
                {
                    url: formURL,
                    type: "POST",
                    data: data,
                    success: function (res) {

                            $('#show_contact_msg').html('<div class="alert alert-success flash-alert mt-2" id="form-success" role="alert"> Votre messgae à été bien envoyer !</div>');
                            $(".flash-alert").slideDown(200).delay(3500).slideUp(200);

                    }
                });
        e.preventDefault();
    });



</script>
@endpush
