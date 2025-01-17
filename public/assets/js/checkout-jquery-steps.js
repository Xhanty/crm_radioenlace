$(function(){
$("#checkoutsteps").steps({
headerTag: "h4",
bodyTag: "section",
transitionEffect: "fade",
enableAllSteps: true,
transitionEffectSpeed: 500,
onStepChanging: function (event, currentIndex, newIndex) {
if ( newIndex === 1 ) {
$('.steps ul').addClass('step-2');
} else {
$('.steps ul').removeClass('step-2');
}
if ( newIndex === 2 ) {
$('.steps ul').addClass('step-3');
} else {
$('.steps ul').removeClass('step-3');
}

if ( newIndex === 3 ) {
$('.steps ul').addClass('step-4');
$('.actions ul').addClass('step-last');
} else {
$('.steps ul').removeClass('step-4');
$('.actions ul').removeClass('step-last');
}
return true;
},
labels: {
finish: "Order again",
next: "Next",
previous: "Previous"
}
});
// Custom Steps Jquery Steps
$('.wizard > .steps li a').click(function(){
$(this).parent().addClass('checked');
$(this).parent().prevAll().addClass('checked');
$(this).parent().nextAll().removeClass('checked');
});
// Custom Button Jquery Steps
$('.forward').click(function(){
$("#wizard").steps('next');
})
$('.backward').click(function(){
$("#wizard").steps('previous');
})
// Checkbox
$('.checkbox-circle label').click(function(){
$('.checkbox-circle label').removeClass('active');
$(this).addClass('active');
})
 $('#checkoutsteps .steps').prepend( "<div class='checkoutline'></div>" );
})

//select2
$(document).ready(function() {
    $('.select2').select2({
        placeholder: 'Choose one',
        searchInputPlaceholder: 'Search',
        width:'100%',
        allowClear: true,
    });
    $('.select2-no-search').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Choose one',
        allowClear: true,
    });
});