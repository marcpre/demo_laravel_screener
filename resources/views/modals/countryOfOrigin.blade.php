{{-- Modal Country of Origin --}}
<div class="modal fade" id="modalCountry" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit</h4>
            </div>
            <div class="modal-body">
                <form action="/edit/{id}" method='POST' class="form-horizontal" id="modal-coo-form">
                    {{ csrf_field() }}
                    <input type="hidden" name='editID' value=''>
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Country of Origin: </label>
                            <div class="col-md-4">
                                <input id="textinput" name="tokenUnderEdit" placeholder="Insert Country of Origin" class="form-control input-md" type="text">
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("click", ".#modalCountry", function () {
        var id = $(this).val();
        url = "/data/" + id;
        $.ajax({
            url: url,
            method: "get"
        }).done(function (response) {
            //Setting input values
            $("input[name='editID']").val(id);
            $("input[name='tokenUnderEdit']").val(response.tokenUnderEdit);

            //Setting submit url
            $("modal-coo-form").attr("action", "/edit/" + id)
        });
    });
</script>

{{-- https://stackoverflow.com/questions/42415926/edit-db-record-with-modal-window --}}
