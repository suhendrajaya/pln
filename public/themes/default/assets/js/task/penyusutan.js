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
         url: $('[name=urlsavepenyusutan]').val(),
         data: datastring,
         success: function (data, status) {

            if (status == 'success') {
               bootbox.alert({
                  title: "Info",
                  message: '<span class="glyphicon glyphicon-saved"  aria-hidden="true"></span> Row(s) has been updated successfully',
                  callback: function () {
                     location.replace($('[name=urlsavepenyusutansuccess]').val());
                  }
               });
            }
         },
         dataType: 'json'
      });
   });



})(jQuery);


function generateSum(arg) {
    var sSum = 0,
           r1 = $('#c-1').val(),
           r2 = $('#c-2').val(),
           r3 = $('#c-3').val(),
           r4 = $('#c-4').val(),
           r5 = $('#c-5').val(),
           r6 = $('#c-6').val(),
           r7 = $('#c-7').val(),
           r8 = $('#c-8').val(),
           r9 = $('#c-9').val(),
           r10 = $('#c-10').val(),
           r11 = $('#c-11').val(),
           r12 = $('#c-12').val(),
           r13 = $('#c-13').val(),
           r14 = $('#c-14').val(),
           r15 = $('#c-15').val(),
           r16 = $('#c-16').val(),
           r17 = $('#c-17').val(),
           r18 = $('#c-18').val(),
           r19 = $('#c-19').val(),
           r20 = $('#c-20').val(),
           r21 = $('#c-21').val(),
           r22 = $('#c-22').val();


   r1 = (r1 == "") ? 0 : parseInt(r1.replace(/[^0-9\.]/g, ''));
   r2 = (r2 == "") ? 0 : parseInt(r2.replace(/[^0-9\.]/g, ''));
   r3 = (r3 == "") ? 0 : parseInt(r3.replace(/[^0-9\.]/g, ''));
   r4 = (r4 == "") ? 0 : parseInt(r4.replace(/[^0-9\.]/g, ''));
   r5 = (r5 == "") ? 0 : parseInt(r5.replace(/[^0-9\.]/g, ''));
   r6 = (r6 == "") ? 0 : parseInt(r6.replace(/[^0-9\.]/g, ''));
   r7 = (r7 == "") ? 0 : parseInt(r7.replace(/[^0-9\.]/g, ''));
   r8 = (r8 == "") ? 0 : parseInt(r8.replace(/[^0-9\.]/g, ''));
   r9 = (r9 == "") ? 0 : parseInt(r9.replace(/[^0-9\.]/g, ''));
   r10 = (r10 == "") ? 0 : parseInt(r10.replace(/[^0-9\.]/g, ''));
   r11 = (r11 == "") ? 0 : parseInt(r11.replace(/[^0-9\.]/g, ''));
   r12 = (r12 == "") ? 0 : parseInt(r12.replace(/[^0-9\.]/g, ''));
   r13 = (r13 == "") ? 0 : parseInt(r13.replace(/[^0-9\.]/g, ''));
   r14 = (r14 == "") ? 0 : parseInt(r14.replace(/[^0-9\.]/g, ''));
   r15 = (r15 == "") ? 0 : parseInt(r15.replace(/[^0-9\.]/g, ''));
   r16 = (r16 == "") ? 0 : parseInt(r16.replace(/[^0-9\.]/g, ''));
   r17 = (r17 == "") ? 0 : parseInt(r17.replace(/[^0-9\.]/g, ''));
   r18 = (r18 == "") ? 0 : parseInt(r18.replace(/[^0-9\.]/g, ''));
   r19 = (r19 == "") ? 0 : parseInt(r19.replace(/[^0-9\.]/g, ''));
   r20 = (r20 == "") ? 0 : parseInt(r20.replace(/[^0-9\.]/g, ''));
   r21 = (r21 == "") ? 0 : parseInt(r21.replace(/[^0-9\.]/g, ''));
   r22 = (r22 == "") ? 0 : parseInt(r22.replace(/[^0-9\.]/g, ''));

   sSum = r1 + r2 + r3 + r4 + r5 + r6 + r7 + r8 + r9 + r10 + r11 + r12 + r13 + r14 + r15
           + r16 + r17 + r18 + r19 + r20 + r21 + r22;
   console.log('generate gan' + sSum);

   $('#c-23').val(addCommas(sSum));
}

function addCommas(nStr) {
   var val = nStr.toString();
   val = val.replace(/[^0-9\.]/g, '');

   if (val != "") {
      valArr = val.split('.');
      valArr[0] = (parseInt(valArr[0], 10)).toLocaleString();
      val = valArr.join('.');
   }

   return val;
}


