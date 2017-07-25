(function ($) {

   $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      async: true
   });

   var formList = $("#form_list");

   /*$("#order_by").change(function(evt) {
    $("#order").val($(this).val());
    formList.submit();
    });*/
   $(".btn-delete").alertModal();
   $(".btn-delete").click(function (e) {
      e.preventDefault();
      var goDel = $(this).attr("href");
      $("#btn-del-yes").click(function (e) {
         e.preventDefault();
         window.location.assign(goDel);
      });
   });

   $("#btn_prevpage").click(function (evt) {
      page = parseInt($("#pageinput").val()) - 1;
      if (page >= 1) {
         $("#pageinput").val(page);
         formList.submit();
      }
   });

   $("#btn_nextpage").click(function (evt) {
      page = parseInt($("#pageinput").val()) + 1;
      if (page <= parseInt($("#total_page").val())) {
         $("#pageinput").val(page);
         formList.submit();
      }
   });

   $("#pageinput").keypress(function (event) {
      if (event.which == 13)
      {
         if ($('#pageinput').val() <= $('#maxpage').val())
         {
            var search = $('#search').val();
            if (search == null || search === '') {
               window.location = $('#jumptopageinput').val() + '?page=' + $('#pageinput').val();
            } else {
               window.location = $('#jumptopageinput').val() + '?page=' + $('#pageinput').val() + '&search=' + search;
            }
         } else
         {
            return false;
         }
      }
   });

// =========   Grid setting 



// ======== CRUD ================================================================================

   $('#pickdate').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      singleClasses: "picker_4",
//      autoUpdateInput: false,
      locale: {
         format: 'DD-MM-YYYY'
      }
   }, function (start, end, label) {
      console.log(start.toISOString(), end.toISOString(), label);
   });

   $('#myForm').on('shown.bs.modal', function () {
      $('#myInputFirst').focus();
   });

   $("#doAdd").click(function (e) {
      e.preventDefault();

      $("#myModalLabel").text("Add New RKAU");
      $("#btnAddNew").show();
      $("#btnUpdate").hide();

      $("#myForm").modal({
         "keyboard": false,
         "backdrop": false,
         "show": true
      });

   });

   $("#btnAddNew").click(function (e) {
//      var datastring = $("#myFormUser").serialize();
//
//      console.log(datastring);
//      return;
      var form = $('#myFormUser')[0];
      var data = new FormData(form);
//      jQuery.each(jQuery('#fileToUpload')[0].files, function (i, file) {
//         data.append('fileToUpload', file);
//      });
//      
      $.ajax({
         type: "POST",
         url: $('[name=urladd]').val(),
         data: data,
         cache: false,
         contentType: false,
         processData: false,
         success: function (data, status) {

            if (status == 'success') {
               bootbox.alert({
                  message: '<span class="glyphicon glyphicon-saved"  aria-hidden="true"></span> Row(s) has been updated successfully',
                  callback: function () {
                     location.reload();
                  }
               });
            }
         },
         dataType: 'json'
      });
   }
   );

   $("#doEdit").click(function (e) {
      e.preventDefault();

      var rows = $('input[name=table_records]:checked');

      if (rows.length != 1) {
         bootbox.alert({
            title: 'Alert',
            message: '<span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Please select 1 record!',
            backdrop: true
//            title: 'Loading',
//            message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>'
         });

         return true;
      }

      var JSONArray = $.parseJSON(rows.attr('data')),
              ignoreColumns = ["password"];

      for (var key in JSONArray) {
         if (ignoreColumns.indexOf(key) < 0)
            $("[name=" + key + "]").val(JSONArray[key]);
      }

      $("#myModalLabel").text("Edit User Form");
      $("[name=btnSave]").attr({
         "id": "doEditSave"
      });
//      $("#myFormUser").attr("action", baseUrl + "/tasks/user/edit");
      $("#btnAddNew").hide();
      $("#btnUpdate").show();


      $("#myForm").modal({
         "keyboard": false,
         "show": true
      });
   });

   $("#btnUpdate").click(function (e) {
      var datastring = $("#myFormUser").serialize();
      $.ajax({
         type: "POST",
         url: baseUrl + '/tasks/user/edit',
         data: datastring,
         success: function (data, status) {

            if (status == 'success') {
               bootbox.alert({
                  title: "Info",
                  message: '<span class="glyphicon glyphicon-saved"  aria-hidden="true"></span> Row(s) has been updated successfully',
                  callback: function () {
                     location.reload();
                  }
               });
            }
         },
         dataType: 'json'
      });
   });

   $("#doDel").click(function (e) {
      e.preventDefault();

      var rows = $('input[name=table_records]:checked');

      if (rows.length < 1)
      {
         bootbox.alert({
            title: "Alert",
            message: '<span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Please select record(s)!',
            backdrop: true
         });
         return true;
      }

      bootbox.confirm({
         title: "Delete row(s)?",
         message: "Are you sure to delete row(s)?",
         buttons: {
            cancel: {
               label: '<i class="fa fa-times"></i> Cancel'
            },
            confirm: {
               label: '<i class="fa fa-check"></i> Confirm'
            }
         },
         callback: function (result) {

            if (result) {
               var sList = "";
               rows.each(function () {
                  sList += $(this).attr('data-id') + ',';
               });

               $.ajax({
                  type: "POST",
                  url: baseUrl + '/tasks/user/delete',
                  data: {ids: sList},
                  success: function (data, status) {

                     if (status == 'success') {
                        bootbox.alert({
                           title: "Info",
                           message: '<span class="glyphicon glyphicon-saved"  aria-hidden="true"></span> Row(s) has been deleted successfully',
                           callback: function () {
                              location.reload();
                           }
                        });
                     }
                  },
                  dataType: 'json'
               });
            }
         }
      });
   });

})(jQuery);

function doAlert(msg) {
   var dialog = bootbox.alert({
      message: '<span class="glyphicon glyphicon-alert" aria-hidden="true"></span> ' + msg,
      backdrop: true
   });
   dialog.init(function () {
      setTimeout(function () {
         dialog.modal('hide');
      }, 5000);
   });
}