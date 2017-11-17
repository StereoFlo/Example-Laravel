$(document).ready(function () {
    $('#content').summernote({
        minHeight: 300,
        toolbar:[
            //[groupname,[list buttons]]
            ['style',['bold','italic','underline']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize','fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph','style']],
            ['height', ['height']],
            ['insert',['picture','link','video','table']],

        ],
    });
});
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