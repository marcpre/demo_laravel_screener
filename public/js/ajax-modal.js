$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();

    //display modal form for creating new product *********************
    $('#btn_add').click(function(){
        $('#btn-save').val("add");
        $('#myModal').modal('show');
    });

    //display modal form for product EDIT ***************************
    $(document).on('click','.open_modal',function(){
        var cryptos_id = $(this).val();
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + '/edit/' + cryptos_id,
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
            //price: $('#price').val(),
        }
        console.log("formData: " + formData);

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();
        var type = "PUT"; //for creating new resource
        var cryptos_id = $('#cryptos_id').val();;
        var my_url = url + '/edit/' + cryptos_id;
        console.log("state: " + state)
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
