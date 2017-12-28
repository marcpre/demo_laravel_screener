$(document).ready(function(){

    
    //get base URL *********************
    var url = $('#url').val();

    //display modal form for creating new product *********************
    $('#btn_add').click(function(){
        $('#btn-save').val("add");
        //$('#frmProducts').trigger("reset");
        $('#myModal').modal('show');
    });

    //display modal form for product EDIT ***************************
    $(document).on('click','.open_modal',function(){
        var product_id = $(this).val();
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + '/edit/' + product_id,
            success: function (data) {
                console.log(data);
                $('#product_id').val(data.id);
                $('#name').val(data.name);
               // $('#price').val(data.price);
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
        var product_id = $('#product_id').val();;
        var my_url = url + '/edit/' + product_id;
        console.log("state: " + state)
        console.log("product_id: " + product_id)
        console.log("my_url: " + my_url)
    /*
        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + product_id;
        } 
    */
        console.log("formData: " + formData);
        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log("data: " + data);
            /*    var product = '<tr id="product' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.price + '</td>';
                product += '<td><button class="btn btn-warning btn-detail open_modal" value="' + data.id + '">Edit</button>';
                product += ' <button class="btn btn-danger btn-delete delete-product" value="' + data.id + '">Delete</button></td></tr>';
                if (state == "add"){ //if user added a new record
                    $('#products-list').append(product);
                }else{ //if user updated an existing record
                    $("#product" + product_id).replaceWith( product );
                }
            */
                $('#frmProducts').trigger("reset"); 
                $('#myModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});
