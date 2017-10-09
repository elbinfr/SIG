/*
* INIT ELEMENT LIKE DATEPICKER
 */
$('.date').datepicker({
    format: "dd/mm/yyyy",
    autoclose: true
});

$('.start_date').datepicker({format: "dd/mm/yyyy"}).on('changeDate', function(ev){
    var dateText = $(this).data('date');

    var endDateTextBox = $('.end_date input');
    if (endDateTextBox.val() !== '') {
        var testStartDate = new Date(dateText);
        var testEndDate = new Date(endDateTextBox.val());
        if (testStartDate > testEndDate) {
            endDateTextBox.val(dateText);
        }
    } else {
        endDateTextBox.val(dateText);
    }

    $('.end_date').datepicker('setStartDate', dateText);
    $('.start_date').datepicker('hide');
});

$('.end_date').datepicker({format: "dd/mm/yyyy"}).on('changeDate', function(ev){
    var dateText = $(this).data('date');
    var startDateTextBox = $('.start_date input');
    if (startDateTextBox.val() !== '') {
        var testStartDate = new Date(startDateTextBox.val());
        var testEndDate = new Date(dateText);
        if (testStartDate > testEndDate) {
            startDateTextBox.val(dateText);
        }
    }
    else {
        startDateTextBox.val(dateText);
    }
    $('.start_date').datepicker('setEndDate', dateText);
    $('.end_date').datepicker('hide');
});