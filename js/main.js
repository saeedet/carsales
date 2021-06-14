//adjusting window height

$(document).ready(function(){
  $('.header').height($(window).height());
})

// required functions for select options in the search box
function removeOption(){
    $('#model1').find('option').remove()
}
function addOption(it1) {
    optionText = it1;
    if (it1 == 'Any Model') {
        optionValue = 'any_model';
    }
    else{
        optionValue = it1;
    }
    $('#model1').append(`<option value="${optionValue}"> ${optionText} </option>`);
}
//AJAX FOR SELECT OPTIONS
function filter(item){

    $.ajax({
        type: "POST",
        url: "ex/filter.php",
        data: { value: item},
        success:function(data){

            removeOption();
            for (var i=0; i<data.length; i++){
                // console.log(data[i])
                addOption(data[i])
            }

        },
        dataType:"json"
    });
}
