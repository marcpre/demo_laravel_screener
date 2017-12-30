// check all checkboxes
$('#checkAllButton').click(function(e){
    $('[id^=revisionBox_]').prop('checked', true);
});

$('#uncheckAllButton').click(function(e){
    $('[id^=revisionBox_]').prop('checked', false);
});
