$('document').ready(function () {


//LOGIN DETAILS
    $("#logindetails").on('submit', (function (e) {
        e.preventDefault();
        $("#error").html('');

        $.ajax({
            url: baseurl + "Login/verifylogin", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            beforeSend: function () {
                $("#error").html('<center><img src="' + baseurl + 'assets/images/preloader/preloader.svg" /> &nbsp; Sending...<br/>Please wait!!</center>');
            },
            success: function (data)   // A function to be called if request succeeds.
            {
                
                var obj = JSON.parse(data);

                if (obj.success == "1") {
                    
                    //is admin
                    $("#error").html(''); //clearing error message
                    $("#logindetails")[0].reset();
                    window.location = baseurl + "Admin";
                    
                    
                }  else if (obj.success == "0") {
                    $("#error").html(''); //clearing error message
                    $("#error").html("<div  class='alert alert-danger' ><center><i class='fa fa-times fa-2x text-danger mb50 animated zoomIn'></i><br />" + obj.message + "</center></div>");


                } else {
                    $("#logindetails")[0].reset();
                    $("#error").html("<div  class='alert alert-danger' ><center><i class='fa fa-check fa-2x text-danger mb50 animated zoomIn'></i><br />OPPS!! Unknown Error Occured.<br /> Please check your deatails and try again</center></div>");

                }
            }

        });


    }));



    
    //Reset Password

    $("#resetdetails").on('submit', (function (e) {
        e.preventDefault();
        $("#error").html('');
        $.ajax({
            url: baseurl + "Login/sendResetMail", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            beforeSend: function () {
                $("#error").html('<center><img src="' + baseurl + 'assets/images/preloader/preloader.svg" /> &nbsp; Sending...<br/>Please wait!!</center>');
            },
            success: function (data)   // A function to be called if request succeeds.
            {
                
                var obj = JSON.parse(data);

                if (obj.success == "1") {
                    $("#error").html(''); //clearing error message
                    $("#resetdetails")[0].reset();
                    $("#error").html("<div  class='alert alert-success' ><center><i class='fa fa-check fa-2x text-success mb50 animated zoomIn'></i><br />" + obj.message + "<br/>Please Check your email for instructions</center></div>");


                } else if (obj.success == "0") {
                    $("#error").html(''); //clearing error message
                    $("#error").html("<div  class='alert alert-danger' ><center><i class='fa fa-times fa-2x text-danger mb50 animated zoomIn'></i><br />" + obj.message + "</center></div>");

                } else {
                    $("#resetdetails")[0].reset();
                    $("#error").html("<div  class='alert alert-success' ><center><i class='fa fa-check fa-2x text-success mb50 animated zoomIn'></i><br />OPPS!! Unknown Error Occured.<br /> Please check your deatails and try again</center></div>");

                }
            },

        });


    }));



    //New Password

    $("#newpassdetails").on('submit', (function (e) {
        e.preventDefault();
        $("#error").html('');

        //check if pass match
        if ($("#pass").val() != $("#pass2").val()) {
            $("#error").html("<div  class='alert alert-danger' ><center><i class='fa fa-times fa-2x text-danger mb50 animated zoomIn'></i><br />Sorry!! Your passwords Does not Match</center></div>"); //clearing error message
            return;
        }

        $.ajax({
            url: baseurl + "Login/UpdatePassword", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            beforeSend: function () {
                $("#error").html('<center><img src="' + baseurl + 'assets/images/preloader/preloader.svg" /> &nbsp; Resetting...<br/>Please wait!!</center>');
            },
            success: function (data)   // A function to be called if request succeeds.
            {    
                
                var obj = JSON.parse(data);

                if (obj.success == "1") {
                    $("#error").html(''); //clearing error message
                    $("#newpassdetails")[0].reset();
                    $("#newpassdetails").html("<div  class='alert alert-success m-3' ><center><i class='fa fa-check fa-2x text-success mb50 animated zoomIn'></i>Your password Changed Successifully\n\
                        Now Sign in with your new credentials <br /> <a  href='"+baseurl+"Login'>Sign In</a> </center></div>");


                } else if (obj.success == "0") {
                    $("#error").html(''); //clearing error message
                    $("#error").html("<div  class='alert alert-danger' ><center><i class='fa fa-times fa-2x text-danger mb50 animated zoomIn'></i><br />" + obj.message + "</center></div>");

                } else {
                    $("#newpassdetails")[0].reset();
                    $("#error").html("<div  class='alert alert-success' ><center><i class='fa fa-check fa-2x text-success mb50 animated zoomIn'></i><br />OPPS!! Unknown Error Occured.<br /> Please check your deatails and try again</center></div>");

                }
                
            }
        });


    }));
    
    
    
  
});