

$('document').ready(function () {

   
    //update admin 
    $("#updatedetails").on('submit', (function (e) {
        e.preventDefault();
        $("#error").html('');
        

        $.ajax({
            url: baseurl + "Admin/Update", // Url to which the request is send
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
                    $("#error").html("<div  class='alert alert-success' ><center><i class='fa fa-check fa-2x text-success mb50 animated zoomIn'></i><br />" + obj.message + "<br /></center></div>");


                } else if (obj.success == "0") {
                    $("#error").html(''); //clearing error message
                    $("#error").html("<div  class='alert alert-danger' ><center><i class='fa fa-times fa-2x text-danger mb50 animated zoomIn'></i><br />" + obj.message + "</center></div>");

                } else {
                    $("#error").html("<div  class='alert alert-danger' ><center><i class='fa fa-check fa-2x text-danger mb50 animated zoomIn'></i><br />OPPS!! Unknown Error Occured.<br /> Please check your deatails and try again</center></div>");

                }
            }
        });

    }));
    
    
    //admin new password
    $("#newpassdetails").on('submit', (function (e) {
        e.preventDefault();
        $("#error").html('');
        
        
        //check if pass match
        if ($("#pass").val() != $("#pass2").val()) {
            $("#error").html("<div  class='alert alert-danger' ><center><i class='fa fa-times fa-2x text-danger mb50 animated zoomIn'></i><br />Sorry!! Your passwords Does not Match</center></div>"); //clearing error message
            return;
        }



        $.ajax({
            url: baseurl + "Admin/updatePass", // Url to which the request is send
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
                    $("#newpassdetails")[0].reset();
                    $("#error").html("<div  class='alert alert-success' ><center><i class='fa fa-check fa-2x text-success mb50 animated zoomIn'></i><br />" + obj.message + "<br /></center></div>");


                } else if (obj.success == "0") {
                    $("#error").html(''); //clearing error message
                    $("#error").html("<div  class='alert alert-danger' ><center><i class='fa fa-times fa-2x text-danger mb50 animated zoomIn'></i><br />" + obj.message + "</center></div>");

                } else {
                    $("#newpassdetails")[0].reset();
                    $("#error").html("<div  class='alert alert-danger' ><center><i class='fa fa-check fa-2x text-danger mb50 animated zoomIn'></i><br />OPPS!! Unknown Error Occured.<br /> Please check your deatails and try again</center></div>");

                }
            }
        });

    }));
    
    
    // Function to preview image after validation
    $(function () {
        $("#image").change(function () {
            $("#imgerror").empty(); // To remove the previous error message
            var file = this.files[0];
            var imagefile = file.type;
            var match = ["image/jpeg", "image/png", "image/jpg"];
            if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
            {
                $('#previewing').attr('src', baseurl + 'assets/images/Users/placeholder/profile-placeholder.jpg');
                $("#imgerror").html("<p  class='alert alert-danger' ><small>Please Select A valid Image File <br/> <u><b>Note</b></u> <br/> Only jpeg, jpg and png Images type allowed</small></p>");
                return false;
            } else
            {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
    function imageIsLoaded(e) {
        $("#image").css("color", "green");
        $('#previewing').css("display", "block");
        $('#previewing').attr('src', e.target.result);
        //$('#previewing').attr('width', '250px');
        $('#previewing').attr('height', '150px');
    }
  

});