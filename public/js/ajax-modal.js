$(document).ready(function () {

    //get base URL *********************
    var url = $('#url').val();

    //display modal form ***************************
    $(document).on('click', '.open_modal', function () {
        var cryptos_id = $(this).attr('value');
        var secOrcoo = $(this).attr('name');

        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + '/token/' + cryptos_id,
            success: function (data) {
                $('#cryptos_id').val(data.id);
                // get country of origin or sector
                if (secOrcoo === "country_of_origin") {
                    $('#name').val(data.country_of_origin);
                    $('#secOrcoo').val("country_of_origin");
                    $("#myModalLabel").append(' <b class="pseudo-text">Country of Origin</b>');
                }
                if (secOrcoo === "sector") {
                    $('#name').val(data.sector);
                    $('#secOrcoo').val("sector");
                    $("#myModalLabel").append(' <b class="pseudo-text">Sector</b>');
                }
                $('#btn-save').val("update");
                $('#myModal').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    //update existing instruments record ***************************
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault();
        var formData = {
            name: $('#name').val(),
            secOrcoo: $('#secOrcoo').val(),
        }

        var type = "POST"; //for creating new resource
        var cryptos_id = $('#cryptos_id').val();;
        var my_url = url + '/token/edit/' + cryptos_id;
        // alert("formData: " + JSON.stringify(formData));

        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                $('.errorName').addClass('hidden');
                
                if ((data.errors)) {
                    setTimeout(function () {
                        $('#myModal').modal('show');
                        toastr.error('Validation error!', 'Error Alert', {
                            timeOut: 5000
                        });
                    }, 500);

                    if (data.errors.name) {
                        $('.errorName').removeClass('hidden');
                        $('.errorName').text(data.errors.name);
                    }
                } else {
                    toastr.success('Thank you for your contribution!', 'Success Alert', {
                        timeOut: 5000
                    });
                    
                    $('#frmProducts').trigger("reset");
                    $(".pseudo-text").remove();
                    $('#myModal').modal('hide')
                }
            },
            error: function (error) {
                console.log("Error: " + error);
            }
        });
    });
});
