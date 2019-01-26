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

$('input[name="dates"]').daterangepicker({
    ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    "opens": "left",
    "alwaysShowCalendars": true,
    "startDate": dates.start_short,
    "endDate": dates.end_short
}, function(start, end, label) {
    dates = {
        start_date: start.format('YYYY-MM-DD'),
        end_date : end.format('YYYY-MM-DD')
    };
    $('#from_date').val(dates.start_date);
    $('#to_date').val(dates.end_date);
});