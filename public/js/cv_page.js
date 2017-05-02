$('.btn-primary').click(function(){
    $('.ielts-check').addClass('hidden');
    $('.toefl-check').addClass('hidden');
    $('.toeic-check').addClass('hidden');
    var count_skill_row = $('.skill-point').size();
    var validateLanguage = validateEnglishSkill();
    var validateSkill = validateSkills(count_skill_row);
    if(!validateLanguage || !validateSkill)
        return false;
});

function validateEnglishSkill(){
    var point = $('#point').val();
    if($('#certificate_id').val()== 1){
        if(0 <= point && point <= 9.0){
            var getIelts = validateIelts(point);
            return getIelts;
        }
        else{
            $('.ielts-check').removeClass('hidden');
            return false;
        }
    }
    else if($('#certificate_id').val()== 2){
        if(0 <= point && point <= 120){
            var getToefl = validateToefl(point);
            return getToefl;
        }
        else{
            $('.toefl-check').removeClass('hidden');
            return false;
        }
    }
    else if($('#certificate_id').val()== 3){
        if(0 <= point && point <= 990){
            var getToeic = validateToeic(point);
            return getToeic;
        }
        else{
            $('.toeic-check').removeClass('hidden');
            return false;
        }
    }
    else{
        return false;
    }
}

function validateSkills(count_skill_row){
    var count_error = 0;
    $.map($('.skill-select'), function(e){
        if($(e).val() == ""){
            count_error++;
        }
    })

    for (var i=1; i<=count_skill_row; i++){
        console.log($("input:radio[name=optradio" + i + "]").val());
        if($("input:radio[name=optradio" + i + "]").val() == ""){
            count_error++;
        }
    }

    if(count_error == 0){
        $('.add-line').css('background', '');
        return true;
    }
    else{
        $('.add-line').css('background', '#F08080');
        return false;
    }
}

function validateIelts(point){
    var arr = [];
    if(point.indexOf('.')){
        arr = point.split('.');
    }
    else if(point.indexOf(',')){
        arr = point.split(',');
    }
    else
        return false;

    if(arr[1] == 0 || arr[1] == 5)
        return true;
    else{
        $('.ielts-check').removeClass('hidden');
        return false;
    }
}

function validateToefl(point){
    if((point % 1) == 0){
        return true;
    }
    else{
        $('.toefl-check').removeClass('hidden');
        return false;
    }
}

function validateToeic(point){
    if((point % 5) == 0){
        return true;
    }
    else{
        $('.toeic-check').removeClass('hidden');
        return false;
    }
}
