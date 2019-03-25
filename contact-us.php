<?php include_once 'header.php' ?>
    <div class="row">

            <!--Section: Contact v.2-->
            <section class="mb-4">

                <!--Section heading-->
                <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
                <!--Section description-->
                <p class="text-center w-responsive mx-auto mb-5 col-lg-4">Do you have any questions? Please do not hesitate to
                    contact us directly. Our team will come back to you within
                    a matter of hours to help you.</p>

                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-9 mb-md-0 mb-5">
                        <form id="contact-form" name="contact-form" action="control/send-mail.php" method="POST">

                            <!--Grid row-->
                            <div class="row">

                                <!--Grid column-->
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <input type="text" id="name" name="name" class="form-control">
                                        <label for="name" class="">Your name</label>
                                    </div>
                                </div>
                                <!--Grid column-->

                                <!--Grid column-->
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <input type="text" id="email" name="email" class="form-control">
                                        <label for="email" class="">Your email</label>
                                    </div>
                                </div>
                                <!--Grid column-->

                            </div>
                            <!--Grid row-->

                            <!--Grid row-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="md-form mb-0">
                                        <input type="text" id="subject" name="subject" class="form-control">
                                        <label for="subject" class="">Subject</label>
                                    </div>
                                </div>
                            </div>
                            <!--Grid row-->

                            <!--Grid row-->
                            <div class="row">

                                <!--Grid column-->
                                <div class="col-md-12">

                                    <div class="md-form">
                                        <textarea type="text" id="message" name="message" rows="2"
                                                  class="form-control md-textarea"></textarea>
                                        <label for="message">Your message</label>
                                    </div>

                                </div>
                            </div>
                            <!--Grid row-->

                        </form>

                        <div class="text-center text-md-left">
                            <a class="btn btn-primary text-white px-auto btn-lg"
                               onclick="document.getElementById('contact-form').submit();">Send</a>
                        </div>
                        <div class="status"></div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-3  text-center">
                        <ul class="list-unstyled mb-0">
                            <li><i class="fas fa-map-marker-alt fa-2x"></i>
                                <address>Södra Blasieholmshamnen 8, 103 27 Stockholm, Sweden</address>
                            </li>

                            <li><i class="fas fa-phone mt-4 fa-2x"></i>
                                <p><a href="tel: 08-679 35 00">+46 (0)8-679 35 00</a></p>
                            </li>

                            <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                                <p><a href="mailto:contact@gyar.se">contact@gyar.se</a></p>
                            </li>
                        </ul>
                    </div>
                    <!--Grid column-->

                </div>

            </section>
            <!--Section: Contact v.2-->
    </div>
    <script>
        function validateForm() {
            var name =  document.getElementById('name').value;
            if (name == "") {
                document.getElementById('status').innerHTML = "Name cannot be empty";
                return false;
            }
            var email =  document.getElementById('email').value;
            if (email == "") {
                document.getElementById('status').innerHTML = "Email cannot be empty";
                return false;
            } else {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if(!re.test(email)){
                    document.getElementById('status').innerHTML = "Email format invalid";
                    return false;
                }
            }
            var subject =  document.getElementById('subject').value;
            if (subject == "") {
                document.getElementById('status').innerHTML = "Subject cannot be empty";
                return false;
            }
            var message =  document.getElementById('message').value;
            if (message == "") {
                document.getElementById('status').innerHTML = "Message cannot be empty";
                return false;
            }
            document.getElementById('status').innerHTML = "Sending...";
            document.getElementById('contact-form').submit();

        }
    </script>

<?php include_once 'footer.php' ?>