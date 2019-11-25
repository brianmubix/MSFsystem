function deleteservice(id) {


    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this user!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
            .then((willDelete) => {
                if (willDelete) {

                    var data = "";
                    $.ajax({
                        url: baseurl + "ServicesList/deleteservice/" + id, // Url to which the request is send
                        type: "POST", // Type of request to be send, called as method
                        data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false, // To send DOMDocument or non processed data file it is set to false
                        success: function (data)   // A function to be called if request succeeds.
                        {
                            if (data == "") {

                                swal("Deleted!", "User successfully deleted!", "success");
                                window.location.reload();
                            } else {
                                swal("Failed!", "" + data, "error");
                            }

                        }
                    });
                } else {
                    //cancel
                }
            });
}

function approveservice(id) {


    swal({
        title: "Are you sure?",
        text: "Approve this service?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
            .then((willDelete) => {
                if (willDelete) {

                    var data = "";
                    $.ajax({
                        url: baseurl + "ServicesList/approveservice/" + id, // Url to which the request is send
                        type: "POST", // Type of request to be send, called as method
                        data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false, // To send DOMDocument or non processed data file it is set to false
                        success: function (data)   // A function to be called if request succeeds.
                        {
                           
                            var obj = JSON.parse(data);

                            if (obj.success == "1") {
                                swal("Approved", ""+obj.message, "success");
                                window.location.reload();

                            } else if (obj.success == "0") {
                                swal("Failed!", "" + obj.message, "error");
                                
                            } else {
                                swal("Failed!", "Unknown Error Ocurred" , "error");
                            }

                        }
                    });
                } else {
                    //cancel
                }
            });
}

function rejectservice(id) {


    swal({
        title: "Are you sure?",
        text: "Reject this service?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
            .then((willDelete) => {
                if (willDelete) {

                    var data = "";
                    $.ajax({
                        url: baseurl + "ServicesList/rejectservice/" + id, // Url to which the request is send
                        type: "POST", // Type of request to be send, called as method
                        data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false, // To send DOMDocument or non processed data file it is set to false
                        success: function (data)   // A function to be called if request succeeds.
                        {
                           

                            var obj = JSON.parse(data);

                            if (obj.success == "1") {
                                swal("Rejected", ""+obj.message, "success");
                                window.location.reload();

                            } else if (obj.success == "0") {
                                swal("Failed!", "" + obj.message, "error");
                                
                            } else {
                                swal("Failed!", "Unknown Error Ocurred" , "error");
                            }

                        }
                    });
                } else {
                    //cancel
                }
            });
}


function filterservice(category) {
    var data = "category=" + category;

    $.ajax({
        url: baseurl + "ServicesList/filteredServices", // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        beforeSend: function () {
            $("#servicelist").html('<tr><td></td><td><img src="' + baseurl + 'assets/images/preloader/preloader.svg" /> &nbsp; loading...Please wait!!</center></td></tr>');
        },
        success: function (data)   // A function to be called if request succeeds.
        {
            $("#servicelist").html(data);
            $("#filterlabel").html("Showing " + category + " Services");
        }
    });

}


$('document').ready(function () {

    //Add Service

    $("#newservicedetails").on('submit', (function (e) {
        e.preventDefault();
        $("#error").html('');

        $.ajax({
            url: baseurl + "ServicesList/NewService", // Url to which the request is send
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
                    $("#newservicedetails")[0].reset();
                    $("#error").html("<div  class='alert alert-success' ><center><i class='fa fa-check fa-2x text-success mb50 animated zoomIn'></i><br />" + obj.message + " </center></div>");

                    $('#previewing').attr('src', baseurl + 'assets/images/Users/placeholder/profile-placeholder.jpg');


                } else if (obj.success == "0") {
                    $("#error").html(''); //clearing error message
                    $("#error").html("<div  class='alert alert-danger' ><center><i class='fa fa-times fa-2x text-danger mb50 animated zoomIn'></i><br />" + obj.message + "</center></div>");

                } else {
                    $("#newservicedetails")[0].reset();
                    $("#error").html("<div  class='alert alert-danger' ><center><i class='fa fa-check fa-2x text-danger mb50 animated zoomIn'></i><br />OPPS!! Unknown Error Occured.<br /> Please check your deatails and try again</center></div>");

                }
            }
        });

    }));



    //update service 
    $("#updateservicedetails").on('submit', (function (e) {
        e.preventDefault();
        $("#error").html('');


        $.ajax({
            url: baseurl + "ServicesList/updateService", // Url to which the request is send
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


});