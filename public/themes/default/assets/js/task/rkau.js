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
//console.log('data');
//console.log(data);
//console.log('status');
//console.log(status);
//
//return;

            if (data.status == 'success') {
               bootbox.alert({
                  message: '<span class="glyphicon glyphicon-saved"  aria-hidden="true"></span> Row(s) has been updated successfully',
                  callback: function () {
                     location.reload();
                  }
               });
            } else {
               bootbox.alert({
                  title: "Alert",
                  message: '<span class="glyphicon glyphicon-alert"  aria-hidden="true"></span> ' + data.message
               });
            }
         },
         dataType: 'json'
      });
   }
   );

   $("#saveRkau").click(function (e) {
      e.preventDefault();

      var datastring = $("#myFormRkauedit").serialize();
      $.ajax({
         type: "POST",
         url: $('[name=urlsaverkau]').val(),
         data: datastring,
         success: function (data, status) {

            if (status == 'success') {
               bootbox.alert({
                  title: "Info",
                  message: '<span class="glyphicon glyphicon-saved"  aria-hidden="true"></span> Row(s) has been updated successfully',
                  callback: function () {
                     location.replace($('[name=urlsaverkausuccess]').val());
                  }
               });
            }
         },
         dataType: 'json'
      });
   });



})(jQuery);

function countVertikal(id) {


   var res = id.split("-");

   if (res[0] == 'b' || res[0] == 'c' || res[0] == 'd' || res[0] == 'e') {
      $('#f-' + res[1]).val(787888787);
   }

   console.log('id');
   console.log(res[0]);
   console.log('f-' +res[1]);
}
function countHorizon(id) {


   var res = id.split("-");

   if (res[0] == 'b' || res[0] == 'c' || res[0] == 'd' || res[0] == 'e') {
      $('#f-' + res[1]).val(787888787);
   }

   console.log('id');
   console.log(res[0]);
   console.log('f-' +res[1]);
}


function addCommas(arg) {
   var id = arg.getAttribute('id');
   countHorizon(id);

   var value = this.value;
   console.log(name);
   return 3;
//   var val = nStr;
//   val = val.replace(/[^0-9\.]/g, '');
//
//   if (val != "") {
//      valArr = val.split('.');
//      valArr[0] = (parseInt(valArr[0], 10)).toLocaleString();
//      val = valArr.join('.');
//   }
//
//   return val;
}
//
//function addCommas(nStr) {
//   var val = nStr;
//   val = val.replace(/[^0-9\.]/g, '');
//
//   if (val != "") {
//      valArr = val.split('.');
//      valArr[0] = (parseInt(valArr[0], 10)).toLocaleString();
//      val = valArr.join('.');
//   }
//
//   return val;
//}