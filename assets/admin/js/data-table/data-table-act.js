
$(document).ready(function () {
  
  $("#data-table-basic").dataTable({
    responsive: true,
    dom: 'Bfrtip',
    buttons: [{
      extend: 'pdf',
      title: 'Ottawa School Of Beauty Ltd. Reports',
      filename: 'ottawa_student_report_pdf',
      exportOptions: {
            columns: [ 0, ':visible' ]
      }      
    }, 
    {
      extend: 'excel',
      title: 'Ottawa School Of Beauty Ltd. Reports',
      filename: 'ottawa_student_report_excel',
      exportOptions: {
            columns: [ 0, ':visible' ]
      }      

    }, 
    {

      extend: 'print',
      title : 'Ottawa School Of Beauty Ltd. Report',
      text: 'print',
      autoPrint: true,
      exportOptions: {
            columns: [ 0, ':visible' ]
      }      

    },
    'colvis'
  ]
  });

});

