function myFunction()
{
    console.log(document.getElementById("demo"));
    document.getElementById("demo").innerHTML = "Paragraph changed.";
    document.getElementById("demo").style.color = "red";
}
$(document).ready(function(e) {

    $('.btn-submit').off().click(function(e){
        e.preventDefault();
        var form = $('#' + $(this).data('formid'));
        form.submit();
    });

    $('.btn-edit-student').off().click(function(e){
        e.preventDefault();
        //populate modal fileds
        $('#name-edit').val($(this).data('name'));
        $('#surname-edit').val($(this).data('surname'));
        $('#years-edit').val($(this).data('years'));
        $('#schools-edit').val($(this).data('school'));
        $('#student-id').val($(this).data('id'));    /*ovaj red sam dodoooooooooooooooooooo*/

        //rise up modal
        $('#editStudentModal').modal('show');
    });

    $('.btn-delete-student').off().click(function(e){
        e.preventDefault();
        $('#student_id').val($(this).data('id'));

        //rise up modal
        $('#deleteStudentModal').modal('show');
    });

    $('#search-term').off().on("propertychange keyup input paste",function(e) {

        var url_ajax = 'http://jpdesign.ba/sime_test/ucenici_janko/components/search_ucenici.php';

        $.ajax({
            url: url_ajax,
            type: 'POST',
            async: true,
            data: {search_term: $(this).val()},
            dataType  : "json",
            cache: false,
            success: function(response) {
                console.log(response);
                if(response != null && response.length != 0)
                {
                    if(response[0] != "no-results")
                    {
                        var list_items = '';
                        for(var i=0; i< response.length; i++)
                        {
                            list_items += '<li><a href="http://jpdesign.ba/sime_test/ucenici_janko/details.php?id='+ response[i].ucenik_id + '">' + response[i].ucenik_ime + ' ' + response[i].ucenik_prezime + '</a></li>';
                        }
                        $('#search-result-list').empty();
                        $('#search-result-list').html(list_items);
                        $('#search-results').css('display','block');
                    }
                    else
                    {
                        $('#search-result-list').empty();
                        $('#search-results').css('display','none');
                    }
                }
                else
                {
                    $('#search-result-list').empty();
                    $('#search-results').css('display','none');
                }
            },
            error: function(response){
                console.log("Error: "+response);
            }
        });

    });

});
