$(document).ready(function (e){
$('#registeration-form').submit(function(e){
    e.preventDefault();
 var fullName = $('#user-full-name').val();
 var emailAddress = $('#user-email').val();
 var password = $('#user-password').val();
 var telephoneNumber = $('#user-telnr').val();

 $(".error").remove();

 if(fullName.length < 5) {
     $('#user-full-name').after('<p class="text-danger">This field requires at least 5 characters</p>');
 }
 if (emailAddress.length < 1){
     $('#user-email').after('<p class="text-danger">This field id required</p>');
 }

}) //end registration-form
}) // end document ready