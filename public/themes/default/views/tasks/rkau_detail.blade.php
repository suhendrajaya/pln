
<div class="container body">
   <div class="main_container">

      <!-- page content -->
      <div class="right_col" role="main">
         <div class="">
            <div class="page-title">
               <div class="title_left">
                  <h3>Penjualan RKAU</h3>
               </div>

               <div class="title_right">
                  <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                     <div class="input-group">
<!--                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                           <button class="btn btn-default" type="button">Go!</button>
                        </span>-->
                     </div>
                  </div>
               </div>
            </div>

            <div class="clearfix"></div>


            <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="x_panel">
                  <div class="x_title">
                     <h2>Data RKAU </h2>

                     <div class="clearfix"></div>
                  </div>

                  <div class="x_content">




                     <div class="well" style="overflow: auto">
                        <form class="form-inline" method="get" action="{{ route('rkau_page')}}">
                           <div class="form-group">
                              <label>Semxam</label><br>
                              <div class="input-prepend input-group">
                                 <select  class="form-control" name="uploadby_id" style="width: 130px">
                                    <option value="">Pilih User</option>
                                    @foreach( $users as $val )
                                    <option value="{{ trim($val->id) }}" {{  $val->id == $search['uploadby_id']? 'selected="selected"':'' }} >{{ $val->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="form-group" style="margin-left: 5px;border-left: #ccc dotted 1px;padding-left: 10px;">
                              <label>Columns</label><br>
                              <div class="input-prepend input-group">
                                 <select  class="form-control" name="tarif_code"  style="width: 130px">
                                    <option value="">Pilih Tarif</option>
                                    @foreach( $tarifs as $val )
                                    <option value="{{ trim($val->tarif_code) }}" {{  $val->tarif_code == $search['tarif_code']? 'selected="selected"':'' }}>{{ $val->tarif_name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="form-group" style="margin-left: 5px;border-left: #ccc dotted 1px;padding-left: 10px;">
                              <label>Context</label><br>
                              <div class="input-prepend input-group">
                                 <select  class="form-control" name="unit_code" style="width: 130px">
                                    <option value="">Pilih Unit</option>
                                    @foreach( $units as $val )
                                    <option value="{{ trim($val->code) }}" {{  $val->code == $search['unit_code']? 'selected="selected"':'' }}>{{ $val->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="form-group">
                              <label>&nbsp;</label><br>
                              <div class="input-prepend input-group">
                                 <select  class="form-control" name="year" style="width: 130px">
                                    <option value="">Pilih Tahun</option>
                                    @for($i = 2017; $i < 2019; $i++)
                                    <option value="{{ $i }}" {{  $i == $search['year']? 'selected="selected"':'' }} >{{ $i }}</option>
                           @endfor
                           </select>
                     </div>
                  </div>
                  <!--                                      <div class="form-group">
                                                                        <label>&nbsp;</label><b                                                         r>
                                                <div class="input-p                                                            repend input-group">
                                                   <select  class="form-control" styl                                                      e="width: 130px">
                                                      <o                                                      ption value="">Sales Tarif</option>
                                                                                           <option value="press">Press</option>
                                                                          <option value="net">Internet</option>
                                                      <option value="mouth">Word of mouth  2</option>
                                                   </select>
                                                                </div>
                   </div>-->
                                                  <!--                           <div clas                                                s="form-group">
                                                <label                                                   >&nbsp;</label><br>
                                                <div class="input-prepend input-group">
                                                   <select  class="form-control"  style="width: 130px">
            <option valu                                                      e="">Sales Tarif</option>
            <option value="press">Press</option>                                                      
            <option value="net">Internet</option>
            <option va                                                      lue="mouth">Word of mouth  2</option>
            </select>
                                                                    </div>
</div>-->
                           <div class="form-group">                  
                              <label>&nbsp;</label><br>
                             <div class="input-prepend input-group">
                                 <button type="submit" class="btn btn-sm btn-primary">Search</button>
                              </div>
                           </div>
                           <div class="form-group" style="margin-left: 75px;border-left: #ccc dotted 1px;padding-left: 10px;margin-bottom: 12px;">
                  <label>Action</label><br>
                              <!--<div class="btn-group">-->
                              <button type="button" id="doAdd"       class="btn btn-sm btn-success">
                                 <span class="docs-tooltip" data-toggle="tooltip" title="">
                                    <span class="fa fa-plus-circle"></span> Add
                                 </span>
                              </button>
                              <button type="button"  class="btn btn-primary btn-sm" id="saveRkau">
                                 <span class="docs-tooltip" data-toggle="tooltip" title="">
                                    <span class="fa fa-pencil"></span> Save
                     </span>
                              </button>
                  <!--
                   <button type="button" id="doDel" class="btn btn-success">
                                                         <span class="docs-tooltip" data-toggle="tooltip" title="">
                                                            <span class="fa fa-trash"></span> Delete
         </span>
                                                      </button>-->
                              <!--</div>-->
                           </div>
                        </form>   
                     </div>

                     <div class="clearfix"></div>
                     <div class="table-responsive" style="overflow-y: hidden;">
                        <form id="myFormRkauedit" method="post" class="form-horizontal form-label-left">
                     <input type="hidden" name="urlsaverkausuccess"  value="{!!  route('rkau_page', ['mode' => 'grid' ,  'page'=> $paging['pageNo'], 'sort'=>'', 'rp'=>'' ]) !!}">
                           <input type="hidden" name="urlsaverkau"  value="{{ route('rkau_save') }}">
                         <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                         <table class="table-style-form">
                            <thead>
                               <tr>
                                  <th colspan="2">Tarif Code </th>
                                  <th>Trw 1 Penjualan (MWh)</th>
                                  <th>Trw 2 Penjualan (MWh)</th>
                                  <th>Trw 3 Penjualan (MWh)</th>
                                  <th>Trw 4 Penjualan (MWh)</th>
                                  <th>Jumlah Penjualan (MWh) RKAU</th>
                                  <th>Trw 1 Pendapatan (Rp  Ribu)</th>
                                  <th>Trw 2 Pendapatan (Rp  Ribu)</th>
                                  <th>Trw 3 Pendapatan (Rp  Ribu)</th>
                                  <th>Trw 4 Pendapatan (Rp  Ribu)</th>
                                  <th>Jumlah Pendapatan (Rp  Ribu) RKAU</th>
                                  <th>Harga Jual (Rp/kWh) RKAU</th>
                               </tr>
                               <tr>

                                    <!--<th>No</th>-->
                                  <th colspan="2">a </th>
                                  <th> b</th>
                                  <th> c</th>
                                  <th> d</th>
                                  <th> e</th>
                                  <th>f=b+c+d+e</th>
                                  <th>g</th>
                                  <th>h</th>
                                  <th>i</th>
                                  <th>j</th>
                                  <th> k=g+h+i+j </th>
                                  <th> l=k/f </th>
                               </tr>
                            </thead>

                            <tbody>
                               @if(count($list))
                               <?php $i = $paging['pageNo'] == 1 ? 1 : ($paging['pageNo'] * $paging['totalPerPage'] - ($paging['totalPerPage'] - 1) ) ?>
                               @foreach($list as $row)

                               @if(empty($row['tarif_code1']) && empty($row['tarif_code2']))

                               <tr class="even pointer">

                                  <td colspan="14">
                                     &nbsp;
                                  </td>
                               </tr>

                               @else
                               <tr class="even pointer">
<!--                                    <td style="text-align: center;">
                                     {{ $i }}
                                  </td>-->
                                  <td width="100">
                                     <input type="hidden" name="id[]" id="id" value="{{ $row['id'] }}">
                                     {{ $row['tarif_code1'] }}
                                  </td>
                                  <td width="150">
                                     {{ $row['tarif_code2'] }}
                                  </td>
                                  <td class="text-right">

                                     <input type="text" class="text-right" id="{{ 'b-'.$i }}" name="pjl_q1[]" value="{{ number_format($row['pjl_q1']) }}" {{ $row['tarif_code1']=='S' ? 'readonly="readonly"':'' }}  style="width: 95px" onkeyup="generateSum(this)" >

                                  </td>
                                  <td  class="text-right">
                                     <input type="text" class="text-right" id="{{ 'c-'.$i }}"name="pjl_q2[]" value="{{ number_format($row['pjl_q2']) }}"  style="width: 95px" onkeyup="generateSum(this);" >

                                  </td>
                                  <td  class="text-right">
                                     <input type="text" class="text-right" id="{{ 'd-'.$i }}"name="pjl_q3[]" value="{{ number_format($row['pjl_q3']) }}"  style="width: 95px"  onkeyup="generateSum(this)">

                                  </td>
                                  <td  class="text-right">
                                     <input type="text" class="text-right" id="{{ 'e-'.$i }}"name="pjl_q4[]" value="{{ number_format($row['pjl_q4']) }}"  style="width: 95px"  onkeyup="generateSum(this)">

                                  </td>
                                  <td> 
                                     <input type="text" class="text-right" id="{{ 'f-'.$i }}" name="pjl_sum[]" value="{{ number_format($row['pjl_sum']) }}" style="width: 95px" readonly="readonly">
                                  </td>
                                  <td  class="text-right">
                                     <input type="text" class="text-right" id="{{ 'g-'.$i }}" name="pdp_q1[]" value="{{ number_format($row['pdp_q1']) }}"   style="width: 95px" onkeyup="generateSum(this)">

                                  </td>
                                  <td  class="text-right">
                                     <input type="text" class="text-right" id="{{ 'h-'.$i }}" name="pdp_q2[]" value="{{ number_format($row['pdp_q2']) }}"   style="width: 95px" onkeyup="generateSum(this)">

                                  </td>
                                  <td  class="text-right">
                                     <input type="text" class="text-right" id="{{ 'i-'.$i }}" name="pdp_q3[]" value="{{ number_format($row['pdp_q3']) }}"  style="width: 95px"  onkeyup="generateSum(this)">

                                  </td>
                                  <td  class="text-right">
                                     <input type="text" class="text-right" id="{{ 'j-'.$i }}" name="pdp_q4[]" value="{{ number_format($row['pdp_q4']) }}"   style="width: 95px" onkeyup="generateSum(this)">

                                  </td>
                                  <td>
                                     <input type="text" class="text-right" id="{{ 'k-'.$i }}" name="pdp_sum[]" value="{{ number_format($row['pdp_sum']) }}"  style="width: 95px" readonly="readonly">
                                  </td>
                                  <td  class="text-right">
                                     <input type="text" class="text-right" id="{{ 'l-'.$i }}" name="selling_price[]"  value="{{ number_format($row['selling_price']) }}" style="width: 95px"  readonly="readonly">

                                  </td>
                               </tr>
                               @endif

                               <?php $i++ ?> 

                               @endforeach
                               @else
                               <tr>
                                  <td colspan="14"><p>No data found.</p></td>
                               </tr>
                               @endif

                            </tbody>
                         </table>
                  </form>
               </div>

               <!--                     <div class="row">
                                       <div class="col-sm-5">
                                          <div class="pull-left">
                                             <input type="hidden" id="maxpage" value="{{ $paging['totalPage'] }}" />
                                             <input type="hidden" id="jumptopageinput" value="{{ route('rkau_page') }}" />
                                             Showing {{ $paging['pageNo'] == 1 ? 1 : ($paging['pageNo'] * $paging['totalPerPage'] - ($paging['totalPerPage'] - 1) ) }} 
                                             to {{$paging['pageNo']  == $paging['totalPage'] ? $paging['totalRec'] : $paging['pageNo'] * $paging['totalPerPage']}} 
                                             of {{ $paging['totalRec'] }} entries</div>
               
                                       </div>
                                       <div class="col-sm-7">
               
                                          @if(count($list))
                                          <div class="btn-group  pull-right">
                                             <a class="btn btn-default btn-sm {!! $paging['pageNo'] == 1 ? 'disabled' : '' !!}" id="btn_prevpage" href="{!! $paging['pageNo'] == 1 ? '#' : route('rkau_page', [ 'mode' => $mode, 'page'=>($paging['pageNo']-1), 'sort'=>'', 'rp'=>'']) !!}"><span class="fa fa-arrow-left">&nbsp;</span></a>
                                             <input id="pageinput" class="fl btn pageinput" type="text" value="{{ $paging['pageNo'] }}" />
                                             <a class="btn btn-default btn-sm {!! $paging['pageNo'] == $paging['totalPage'] ? 'disabled' : '' !!}" id="btn_nextpage" href="{!! $paging['pageNo'] == $paging['totalPage'] ? '#' : route('rkau_page', [  'mode' => $mode, 'page'=>($paging['pageNo']+1), 'sort'=>'', 'rp'=>'']) !!}"><span class="fa fa-arrow-right">&nbsp;</span></a>
                                          </div>
                                          @endif
                                       </div>
                                    </div>-->
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<!-- /page content -->

</div>
</div>

<!--form yeah --> 
<div class="modal fade bs-example-modal-lg" id="myForm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <form id="myFormUser" method="post" data-parsley-validate="" enctype="multipart/form-data" class="form-horizontal form-label-left" novalidate="">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <input type="hidden" name="urladd" value="{{ route('rkau_add') }}">

            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
               </button>
               <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
               <!--               <div class="form-group">
                                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Submission status code <span class="required">*</span></label>
                                 <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="submission_status_code" required="required" class="form-control col-md-7 col-xs-12">
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Unit code <span class="required">*</span></label>
                                 <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="unit_code" required="required" class="form-control col-md-7 col-xs-12">
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Year code <span class="required">*</span></label>
                                 <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="year_code" required="required" class="form-control col-md-7 col-xs-12">
                                 </div>
                              </div>
               -->
               <div class="form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">&nbsp;</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     Please download template first! <a href="{{ route('rkau_down') }}" target="_blank"><b>click here</b></a>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Excel file <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="file" name="fileToUpload" id="fileToUpload">
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
               <button type="button" id="btnAddNew" class="btn btn-sm btn-primary">Add New</button>
               <button type="button" id="btnUpdate" class="btn btn-sm btn-primary">Update Row</button>
            </div>
         </form>

      </div>
   </div>
</div>
<!--form yeah --> 
<!--<div class="modal fade bs-example-modal-lg" id="myForm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <form id="myFormUser" method="post" data-parsley-validate="" enctype="multipart/form-data" class="form-horizontal form-label-left" novalidate="">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <input type="hidden" name="urladd" id="token" value="{{ route('rkau_add') }}">
            <input type="hidden" name="id" id="id" value="">

            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
               </button>
               <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Submission status code <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" name="submission_status_code" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Unit code <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" name="unit_code" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Year code <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" name="year_code" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Version code <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" name="version_code" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Excel file <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="file" name="fileToUpload" id="fileToUpload">
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="button" id="btnAddNew" class="btn btn-primary">Add New</button>
               <button type="button" id="btnUpdate" class="btn btn-primary">Update Row</button>
            </div>
         </form>

      </div>
   </div>
</div>-->