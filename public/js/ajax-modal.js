$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();
    console.log("url: " + url)
    
    //display modal form for product EDIT ***************************
    $(document).on('click','.open_modal',function(){
        var cryptos_id = $(this).attr('value');
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + '/token/' + cryptos_id,
            success: function (data) {
                console.log(data);
                $('#cryptos_id').val(data.id);
                $('#name').val(data.name);
                $('#btn-save').val("update");
                $('#myModal').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    //create new product / update existing product ***************************
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault();
        var formData = {
            name: $('#name').val(),
        }
        console.log("formData: " + formData);

        var type = "POST"; //for creating new resource
        var cryptos_id = $('#cryptos_id').val();;
        var my_url = url + '/token/edit/' + cryptos_id;
        console.log("cryptos_id: " + cryptos_id)
        console.log("my_url: " + my_url)
        console.log("formData: " + formData);
        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log("data: " + data);
                $('#frmProducts').trigger("reset"); 
                $('#myModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});
