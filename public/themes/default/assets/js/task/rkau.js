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

   $('#' + id).val(addCommas($('#' + id).val()));

//   if (res[0] == 'b' || res[0] == 'c' || res[0] == 'd' || res[0] == 'e') {

   var sSum = 0,
           r1 = $('#' + res[0] + '-1').val(),
           r2 = $('#' + res[0] + '-2').val(),
           r3 = $('#' + res[0] + '-3').val(),
           r4 = $('#' + res[0] + '-4').val(),
           r5 = $('#' + res[0] + '-5').val(),
           r6 = $('#' + res[0] + '-6').val(),
           r7 = $('#' + res[0] + '-7').val();


   r1 = (r1 == "") ? 0 : parseInt(r1.replace(/[^0-9\.]/g, ''));
   r2 = (r2 == "") ? 0 : parseInt(r2.replace(/[^0-9\.]/g, ''));
   r3 = (r3 == "") ? 0 : parseInt(r3.replace(/[^0-9\.]/g, ''));
   r4 = (r4 == "") ? 0 : parseInt(r4.replace(/[^0-9\.]/g, ''));
   r5 = (r5 == "") ? 0 : parseInt(r5.replace(/[^0-9\.]/g, ''));
   r6 = (r6 == "") ? 0 : parseInt(r6.replace(/[^0-9\.]/g, ''));
   r7 = (r7 == "") ? 0 : parseInt(r7.replace(/[^0-9\.]/g, ''));

   sSum = r1 + r2 + r3 + r4 + r5 + r6 + r7;

   $('#' + res[0] + '-8').val(addCommas(sSum));

   var rSum = 0,
           r9 = $('#' + res[0] + '-9').val(),
           r10 = $('#' + res[0] + '-10').val(),
           r11 = $('#' + res[0] + '-11').val(),
           r12 = $('#' + res[0] + '-12').val(),
           r13 = $('#' + res[0] + '-13').val(),
           r14 = $('#' + res[0] + '-14').val(),
           r15 = $('#' + res[0] + '-15').val(),
           r16 = $('#' + res[0] + '-16').val();


   r9 = (r9 == "") ? 0 : parseInt(r9.replace(/[^0-9\.]/g, ''));
   r10 = (r10 == "") ? 0 : parseInt(r10.replace(/[^0-9\.]/g, ''));
   r11 = (r11 == "") ? 0 : parseInt(r11.replace(/[^0-9\.]/g, ''));
   r12 = (r12 == "") ? 0 : parseInt(r12.replace(/[^0-9\.]/g, ''));
   r13 = (r13 == "") ? 0 : parseInt(r13.replace(/[^0-9\.]/g, ''));
   r14 = (r14 == "") ? 0 : parseInt(r14.replace(/[^0-9\.]/g, ''));
   r15 = (r15 == "") ? 0 : parseInt(r15.replace(/[^0-9\.]/g, ''));
   r16 = (r16 == "") ? 0 : parseInt(r16.replace(/[^0-9\.]/g, ''));

   rSum = r9 + r10 + r11 + r12 + r13 + r14 + r15 + r16;

   $('#' + res[0] + '-17').val(addCommas(rSum));

   var bSum = 0,
           b18 = $('#' + res[0] + '-18').val(),
           b19 = $('#' + res[0] + '-19').val(),
           b20 = $('#' + res[0] + '-20').val(),
           b21 = $('#' + res[0] + '-21').val(),
           b22 = $('#' + res[0] + '-22').val(),
           b23 = $('#' + res[0] + '-23').val();


   b18 = (b18 == "") ? 0 : parseInt(b18.replace(/[^0-9\.]/g, ''));
   b19 = (b19 == "") ? 0 : parseInt(b19.replace(/[^0-9\.]/g, ''));
   b20 = (b20 == "") ? 0 : parseInt(b20.replace(/[^0-9\.]/g, ''));
   b21 = (b21 == "") ? 0 : parseInt(b21.replace(/[^0-9\.]/g, ''));
   b22 = (b22 == "") ? 0 : parseInt(b22.replace(/[^0-9\.]/g, ''));
   b23 = (b23 == "") ? 0 : parseInt(b23.replace(/[^0-9\.]/g, ''));

   bSum = b18 + b19 + b20 + b21 + b22 + b23;

   $('#' + res[0] + '-24').val(addCommas(bSum));

   var iSum = 0,
           i25 = $('#' + res[0] + '-25').val(),
           i26 = $('#' + res[0] + '-26').val(),
           i27 = $('#' + res[0] + '-27').val(),
           i28 = $('#' + res[0] + '-28').val(),
           i29 = $('#' + res[0] + '-29').val(),
           i30 = $('#' + res[0] + '-30').val(),
           i31 = $('#' + res[0] + '-31').val(),
           i32 = $('#' + res[0] + '-32').val();

   i25 = (i25 == "") ? 0 : parseInt(i25.replace(/[^0-9\.]/g, ''));
   i26 = (i26 == "") ? 0 : parseInt(i26.replace(/[^0-9\.]/g, ''));
   i27 = (i27 == "") ? 0 : parseInt(i27.replace(/[^0-9\.]/g, ''));
   i28 = (i28 == "") ? 0 : parseInt(i28.replace(/[^0-9\.]/g, ''));
   i29 = (i29 == "") ? 0 : parseInt(i29.replace(/[^0-9\.]/g, ''));
   i30 = (i30 == "") ? 0 : parseInt(i30.replace(/[^0-9\.]/g, ''));
   i31 = (i31 == "") ? 0 : parseInt(i31.replace(/[^0-9\.]/g, ''));
   i32 = (i32 == "") ? 0 : parseInt(i32.replace(/[^0-9\.]/g, ''));

   iSum = i25 + i26 + i27 + i28 + i29 + i30 + i31 + i32;

   $('#' + res[0] + '-33').val(addCommas(iSum));

   var pSum = 0,
           p34 = $('#' + res[0] + '-34').val(),
           p35 = $('#' + res[0] + '-35').val(),
           p36 = $('#' + res[0] + '-36').val(),
           p37 = $('#' + res[0] + '-37').val(),
           p38 = $('#' + res[0] + '-38').val(),
           p39 = $('#' + res[0] + '-39').val(),
           p40 = $('#' + res[0] + '-40').val();

   p34 = (p34 == "") ? 0 : parseInt(p34.replace(/[^0-9\.]/g, ''));
   p35 = (p35 == "") ? 0 : parseInt(p35.replace(/[^0-9\.]/g, ''));
   p36 = (p36 == "") ? 0 : parseInt(p36.replace(/[^0-9\.]/g, ''));
   p37 = (p37 == "") ? 0 : parseInt(p37.replace(/[^0-9\.]/g, ''));
   p38 = (p38 == "") ? 0 : parseInt(p38.replace(/[^0-9\.]/g, ''));
   p39 = (p39 == "") ? 0 : parseInt(p39.replace(/[^0-9\.]/g, ''));
   p40 = (p40 == "") ? 0 : parseInt(p40.replace(/[^0-9\.]/g, ''));

   pSum = p34 + p35 + p36 + p37 + p38 + p39 + p40;

   $('#' + res[0] + '-41').val(addCommas(pSum));

   var tclSum = 0,
           tcl42 = $('#' + res[0] + '-42').val(),
           tcl43 = $('#' + res[0] + '-43').val(),
           tcl44 = $('#' + res[0] + '-44').val();

   tcl42 = (tcl42 == "") ? 0 : parseInt(tcl42.replace(/[^0-9\.]/g, ''));
   tcl43 = (tcl43 == "") ? 0 : parseInt(tcl43.replace(/[^0-9\.]/g, ''));
   tcl44 = (tcl44 == "") ? 0 : parseInt(tcl44.replace(/[^0-9\.]/g, ''));

   tclSum = p34 + p35 + p36;

   $('#' + res[0] + '-45').val(addCommas(sSum + rSum + bSum + iSum + pSum + tclSum));

   var subsidi = 0,
           sub45 = $('#' + res[0] + '-45').val(),
           sub48 = $('#' + res[0] + '-48').val();

   subsidi = sub45 - sub48;

   $('#' + res[0] + '-47').val(addCommas(subsidi));

}
function countHorizon(id) {

   var res = id.split("-");

   $('#' + id).val(addCommas($('#' + id).val()));

//   if (res[0] == 'b' || res[0] == 'c' || res[0] == 'd' || res[0] == 'e') {

   var pjlSum = 0,
           b = $('#b-' + res[1]).val(),
           c = $('#c-' + res[1]).val(),
           d = $('#d-' + res[1]).val(),
           e = $('#e-' + res[1]).val();


   b = (b == "") ? 0 : parseInt(b.replace(/[^0-9\.]/g, ''));
   c = (c == "") ? 0 : parseInt(c.replace(/[^0-9\.]/g, ''));
   d = (d == "") ? 0 : parseInt(d.replace(/[^0-9\.]/g, ''));
   e = (e == "") ? 0 : parseInt(e.replace(/[^0-9\.]/g, ''));

   pjlSum = b + c + d + e;

   $('#f-' + res[1]).val(addCommas(pjlSum));

//   } else if (res[0] == 'g' || res[0] == 'h' || res[0] == 'i' || res[0] == 'j') {

   var pdpSum = 0,
           g = $('#g-' + res[1]).val(),
           h = $('#h-' + res[1]).val(),
           i = $('#i-' + res[1]).val(),
           j = $('#j-' + res[1]).val();


   g = (g == "") ? 0 : parseInt(g.replace(/[^0-9\.]/g, ''));
   h = (h == "") ? 0 : parseInt(h.replace(/[^0-9\.]/g, ''));
   i = (i == "") ? 0 : parseInt(i.replace(/[^0-9\.]/g, ''));
   j = (j == "") ? 0 : parseInt(j.replace(/[^0-9\.]/g, ''));

   pdpSum = g + h + i + j;

   $('#k-' + res[1]).val(addCommas(pdpSum));
//   }

   console.log('pdfSum: ' + pdpSum + ' pjlSum: ', pjlSum);

   $('#l-' + res[1]).val(addCommas(pdpSum / pjlSum));

}


function generateSum(arg) {
   var id = arg.getAttribute('id');
   countVertikal(id);
   countHorizon(id);
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


