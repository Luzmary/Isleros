$(document).ready(function() {

    
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });

    $(".file-upload2").on('change', function(){
        readURL(this);
    });

    $(".upload-button2").on('click', function() {
        $(".file-upload2").click();
     });

    
    
});

// SideNav Default Options
$('.button-collapse').sideNav({
    closeOnClick: true, // Closes side-nav on &lt;a&gt; clicks, useful for Angular/Meteor
    });

// Material Select Initialization
$(document).ready(function() {
    $('.mdb-select').materialSelect();
    });


