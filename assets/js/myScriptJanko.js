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

    $('#search-term-ucenici').off().on("propertychange keyup input paste",function(e) {

        //$('#search-form').attr('action', $('#search-form').data('action') + '?search=' + $(this).val());

        var url_ajax = 'http://jpdesign.ba/sime_test/ucenici_janko/components_janko/search.php';

        $.ajax({                 //ajax funkcija, dole su njeni settings
            url: url_ajax,              //URL kome se salje rikvest
            type: 'POST',      //metod slanja rikvesta
            async: true,   //po difoultu je true, nacin slanja podataka; asinhrona komunikacija klijenta i servera
            data: {search_term: $(this).val()},     //podatak koji se salje serveru, konvertovan u string ako vec nije string, proslijedjen kroz URL kao GET
            dataType  : "json",     //tip podataka koji server treba da vrati, ovde je to json,
            cache: false,                           // posto je false, zahtijevana stranica nece biti kesirana
            success: function(response) {             //funkcija koja se poziva ako je rikvest uspjesan
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
            error: function(response){           //funkcija koja se poziva ako je rikvest neuspjesan
                console.log("Error: "+response);
            }
        });

    });


    $('.submitEnter').keypress(function(e) {
        if(e.which == 13) {
            if($(this).val() != '')
                window.location.href = $(this).data('url') + '?search=' + $(this).val();
            else
                window.location.href = $(this).data('url');
        }
    });

    $('#btn-read-students').off().click(function(){

        $('#students-table').empty();
        $('#loading').css('display','block');
        $.ajax({
            url : "http://jpdesign.ba/sime_test/ucenici_janko/components_janko/read_students.php",
            type: "POST",
            data: {skola_id : $(this).data('id')},
            dataType  : "text",
            cache: false,
            success: function(response){
                console.log(response);
                $('#loading').css('display','none');
                $('#students-table').html(response);
            }
        });
    });

    $('#jib').off().on("propertychange keyup input paste",function(e) {

        $.ajax({
            url: "http://jpdesign.ba/sime_test/ucenici_janko/components_janko/validate_input.php",
            type: "POST",
            data: {input_name: $(this).attr("name"), input_value: $(this).val()},
            dataType: "json",
            cache: false,
            success: function(response){
                console.log(response);
                validate_input('jib',response);
            }

        });

    });

    function validate_input(input_id, validation)
    {
        var input_label_id = '#' + input_id + '-label';
        var current_class = $('#'+input_id).parent('div').attr('class');
        if(validation.validation_message != "")
        {
            $(input_label_id).css('display','block');
            $(input_label_id).empty();
            $(input_label_id).html(validation.validation_message);
            //add validation class on parent div of element
            $('#'+input_id).parent('div').removeClass(current_class);
            $('#'+input_id).parent('div').addClass('form-group ' + validation.validation_state);
        }
    }

});
