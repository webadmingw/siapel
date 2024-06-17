$(document).ready(function() {
    var localTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    $(".info-time").each(function() {
        var unixTimestamp = $(this).data("datetime");
        var datetime = new Date(unixTimestamp * 1000);
        
        var localTime = datetime.toLocaleString('id-ID', { 
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            timeZone: localTimeZone,
            timeZoneName: 'short'
        }).split('.').join(':');
        $(this).html(localTime);
    });

    function updateDateTime() {
        var currentDateTime = new Date();
        var formattedDateTime = currentDateTime.toLocaleString('id-ID', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            timeZone: localTimeZone,
            timeZoneName: 'short'
        }).split('.').join(':');
        $('#clock').html(formattedDateTime);
    }

    setInterval(updateDateTime, 1000);
    updateDateTime();
});
