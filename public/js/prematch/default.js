$('#countries').change(function(){

    $('#leagues')
      .find('option')
      .remove()
      .end();

    var country_id = $(this).val();

    for (var i = 0; i < leagues[country_id].length; i++) {
        thisLeague = leagues[country_id][i];
        var option = $('<option/>');
        option.attr({ 'value': thisLeague.id }).text(thisLeague.name);
        $('#leagues').append(option);
    }
});