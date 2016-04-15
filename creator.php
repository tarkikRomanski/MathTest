
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Конструктор тестів</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-select.min.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/bootstrap-select.min.js"></script>
</head>
<body>
<div class="row-fluid">
    <h2 class="texr-center">Новий тест</h2>
	<div class="span6 pull-center">
        <p>
            <label for="test_title">Введіть назву тесту:
                <input class="input-xxlarge field" type="text" id="test_title" />
            </label>
        </p>
        <p>
            <div class="input-append">
                <label>Введіть тривалість проходження тесту в секундах:
                        <input type="number" class="input-mir field" id="test_time"><span class="add-on">с.</span>
                </label>
            </div>
        </p>
        <p>
            <label for="test_teacher">Введіть ім’я викладача:
                <input type="text" class="input-medium field" id="test_teacher">
            </label>
        </p>
        <p>
            <div class="input-append">
                <label for="test_system">Введіть систему оцінювання:
                    <input type="number" class="input-mir field text-right" id="test_system"><span class="add-on">-бальна</span>
                </label>
            </div>
        </p>

        <div id="question_array">
        </div>

        <button class="btn btn-large btn-warning" id="add_question">Добавити питання</button>
        <button class="btn btn-large btn-info" id="send_data">Далі <i class="icon-arrow-right icon-white"> </i> </button>
    </div>

    <div class="alert alert-info" style="z-index:100; position: fixed; top: 0px; opacity: 0;">Виберіть правильні відповіді</div>
    <div class="alert alert-error offset10" style="z-index:100; position:fixed; top: 0px; opacity: 0"></div>
    <div class="alert alert-success span11"  style="z-index:300; position:fixed; bottom: 5px; visibility: hidden; left: 0;"></div>
</div>

<form action="addTest.php" method="post"  id="send">
    <input type="hidden" name="status" id="status">
</form>

<script type="text/javascript">

    var newTestSettings = function(){
        $('input').val("");
        $('.field').removeAttr('disabled');
        $('input:radio').removeAttr('');
        $('input:radio').attr('disabled','disabled');
        $('#add_question').removeAttr('disabled');
        $('.add_e').removeAttr('disabled');
    }

    newTestSettings();

    var question = 1;
    var step = 0;

    var getQuestionTemplate = function(){
        return '<hr><div class="question_card" question="'+question+'"><span>'+question+'. </span><p><label for="question_title">Питання: <br><input type="text" name="question_title" class="input-xxlarge field"></label></p><h5>Варіанти відповіді: </h5><div class="e_card">'+getETemplate(1, question)+'</div> <p><button class="btn btn-success btn-small add_e" question="'+question+'">Добавити варіант відповіді</button></p></div>';
    }

    var getETemplate = function(e, parent){
        return '<hr class="selector_e btn-info"><div class="input-append e" e="'+e+'"><label for="">'+e+'.<input type="text" class="input-xlarge field"><span class="add-on"><input type="radio" name="true'+parent+'" value="'+e+'" disabled /></span></label></div>';
    }

    var addQuestion = function(){
        alert(question);
        $('#question_array').append(getQuestionTemplate());
        question++;
        $('.add_e').click(addE);
    }

    var addE = function() {
        var i = $(this).attr("question");
        var buffE = $('.question_card[question='+i+']').find('.e').last().attr('e') * 1;
        $('.question_card[question='+i+']').find('.e_card').append(getETemplate((buffE+1), i));
    }

    addQuestion();
    $("#add_question").click(addQuestion);

    var createJSON = function() {
        var mJSON = '{';
            var testTitle, testTeacher, testTime, testSystem, question = '';
            testTitle = $('#test_title').val();
            testTeacher = $('#test_teacher').val();
            testTime = $('#test_time').val();
            testSystem = $('#test_system').val();
            var eCount = 0;
            var questionCount = 0;
            $('.question_card').each(function(){
                eCount = 0;
                var bufer = $(this).find("[name=question_title]").val();
                bufer = JSON.stringify(bufer);
                question += ', "question'+ $(this).attr("question")+'": {"title":'+bufer;
                $(this).find('.e').each(function() {
                    bufer = $(this).find('input:text').val();
                    bufer = JSON.stringify(bufer);
                    question += ', "e'+ $(this).attr('e') + '":' + bufer;
                    eCount++;
                });
                question += ', "true":"'+$(this).find('input:checked').val()+'", "count":"'+eCount+'"';
                question += '}';
                questionCount++;
            });
            question += ', "count":"'+questionCount+'"';
            mJSON += '"title":"'+testTitle+'", "teacher":"'+testTeacher+'", "time":"'+testTime+'", "system":"'+testSystem+'"' + question + "}";

        return mJSON;
    }


    $('#send_data').click(function(){
        if(step==0) {
            var emptyCount = 0;
            $('.field').each(function(){
                if($(this).val() == "" || $(this).val().length < 1) {
                    emptyCount++;
                    $(this).addClass('red');
                    setTimeout(function(){$('.red').removeClass('red')}, 500);
                }
            });

            if(emptyCount==0) {
                $('.alert-error').css("opacity", "0");
                $('.alert-info').css("opacity", "1");
                step++;
                $('.field').attr('disabled', 'disabled');
                $('input:radio').removeAttr('disabled');
                $('#add_question').attr('disabled', 'disabled');
                $('.add_e').attr('disabled', 'disabled');
            } else {
                $('.alert-error').css("opacity", "1");
                $('.alert-error').html("Деякі поля пусті");
            }
        } else if(step==1) {
            $('.alert-info').css("opacity", "0");
            if($('input:checked').size() != $('.question_card').size()) {
                $('.alert-error').css("opacity", "1");
                $('.alert-error').html("Оберіть правильні відповіді!");
            } else {
                $('.alert-error').css("opacity", "0");
                $('input:radio').attr('disabled', 'disabled');
                step++;
            }
        } else if(step==2) {
            $.post('addTest.php', {status:createJSON()}, function(data) {
                $('.alert-success').css("visibility", "visible");
                $('.alert-success').html("Запит успішно виконано!");
                setTimeout(function(){$('.alert-success').css("visibility", "hidden");}, 2000)
                setTimeout(function () {
                    newTestSettings();
                }, 1000);
            });
        }
    });

</script>
</body>
</html>
