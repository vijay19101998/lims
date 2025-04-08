$(function() {
    'use strict';
    // date picker 
    if($('#flatpickr-date').length) {
      flatpickr("#flatpickr-date", {
        wrap: true,
        dateFormat: "d-m-Y",
      });
    }
  
    $('#adduser').click(function(){
          $('#userModal').modal('show');
          $('#userForm')[0].reset();
      $('.modal-title').html("<i class='fa fa-plus'></i> Add User");
          $('#action').val('Add');
          $('#form_action').val('insert');
      $("form").each(function(){
        $(this).find(':input,textarea,select').removeClass('is-valid'); //<-- Should return all input elements in that specific form.
        $(this).find(':input,textarea,select').removeClass('is-invalid'); //<-- Should return all input elements in that specific form.
      });
      });
    
      $(document).ready( function () {
        function filterGlobal () {
           $('#sampleTestingList').DataTable({
        destroy: true,
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax':{
              url:'ajax-query/masterTable.php',
              type:'POST',
              data:{
                action:'sampleTestingList',
                testCategory:$('#testCategory').val(),
                testGroup:$('#testGroup').val(),
                materialGroup:$('#materialGroup').val(),
                materialItem:$('#materialItem').val(),
                materialGroup:$('#materialGroup').val()
              },
              dataType:'json'
          },
      'columns': [
          { data: 'date' },
          { data: 'sample_id' },
          { data: 'sample_code' },
          { data: 'prepared_by' },
          { data: 'action' }

      ]
  });
  $('#filterModal').modal('hide');
}

//
$('#search-action-btn').on( 'click', function () {
filterGlobal();
});
filterGlobal();

});

    // $(document).ready(function(){
    //     $("#testcat").on("change",function(){
    //       var test_category_id = $(this).val();
    //       var action = 'gettestcat';
    //       $.ajax({
    //         url: "ajax-query/masterSubmit.php",
    //         type:"POST",
    //         cache:false,
    //         data:{test_category_id:test_category_id, action:action},
    //         success:function(data){
    //           console.log(data);
    //           $("#testgroup").html(data);
    //         }
    //       });     
    //     });
    //   });
  });