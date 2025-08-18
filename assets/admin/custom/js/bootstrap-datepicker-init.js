// Bootstrap Datepicker initialization for admin module
$(document).ready(function() {
    // Initialize all date inputs with class 'datepicker'
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
        orientation: 'bottom'
    });
    
    // Initialize date inputs with type 'date' to use Bootstrap datepicker instead
    $('input[type="date"]').each(function() {
        $(this).attr('type', 'text').addClass('datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            orientation: 'bottom'
        });
    });
});
