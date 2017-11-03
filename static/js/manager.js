$('[id^=work_]').click(function () {
    var url = $(this).attr('data-url');
    $.get(url)
        .done(function (data) {
            console.log(data)
        })
        .fail(function (data) {
            console.log(data)
        });
});