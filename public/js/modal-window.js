$(document).on("click", ".#modalCountry", function() {
  var id = $(this).val()
  url = "/data/" + id
  $.ajax({
    url: url,
    method: "get"
  }).done(function(response) {
    //Setting input values
    $("input[name='editID']").val(id)
    $("input[name='tokenUnderEdit']").val(response.tokenUnderEdit)

    //Setting submit url
    $("modal-coo-form").attr("action", "/edit/" + id)
  })
})
