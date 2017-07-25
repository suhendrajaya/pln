
<div class="container body">
   <div class="main_container">

      <!-- page content -->
      <div class="right_col" role="main">
         <div class="">
            <div class="page-title">
               <div class="title_left">
                  <h3>RKAU <small>Some examples to get you started</small></h3>
               </div>

               <div class="title_right">
                  <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                     <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                           <button class="btn btn-default" type="button">Go!</button>
                        </span>
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
                     <div class="btn-group" style="padding-bottom: 15px;">
                        <button type="button" id="doAdd" class="btn btn-success">
                           <span class="docs-tooltip" data-toggle="tooltip" title="">
                              <span class="fa fa-plus-circle"></span> Add
                           </span>
                        </button>
                        <button type="button"  class="btn {{  $mode == 'edit'? 'btn-danger' : 'btn-success' }}" {{ $mode == 'edit'? "id=saveRkau":'' }} @if($mode == 'edit') '' @else onclick="location.href = '{!!  route('rkau_page', ['mode' => 'edit' ,  'page'=> $paging['pageNo'], 'sort'=>'', 'rp'=>'', 'search'=>$persist ]) !!}'" @endif>
                                <span class="docs-tooltip" data-toggle="tooltip" title="">
                              <span class="fa fa-pencil"></span> {{  $mode == 'edit'? 'Save' : 'Edit' }}
                           </span>
                        </button>
                        <!--
                                                <button type="button" id="doDel" class="btn btn-success">
                                                   <span class="docs-tooltip" data-toggle="tooltip" title="">
                                                      <span class="fa fa-trash"></span> Delete
                                                   </span>
                                                </button>-->
                     </div>
                     <div class="clearfix"></div>
                     <div class="table-responsive">
                        <form id="myFormRkauedit" method="post" class="form-horizontal form-label-left">
                           <input type="hidden" name="urlsaverkausuccess"  value="{!!  route('rkau_page', ['mode' => 'grid' ,  'page'=> $paging['pageNo'], 'sort'=>'', 'rp'=>'', 'search'=>$persist ]) !!}">
                           <input type="hidden" name="urlsaverkau"  value="{{ route('rkau_save') }}">
                           <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                           <table id="tblrowclick" class="table table-striped jambo_table bulk_action">
                              <thead>
                                 <tr class="headings">
                                    <th class="column-title" width="20px">No </th>
                                    <th class="column-title">Tarif Code </th>
                                    <th class="column-title">Trw 1 Penjualan (MWh)</th>
                                    <th class="column-title">Trw 2 Penjualan (MWh)</th>
                                    <th class="column-title">Trw 3 Penjualan (MWh)</th>
                                    <th class="column-title">Trw 4 Penjualan (MWh)</th>
                                    <th class="column-title">Jumlah Penjualan (MWh) RKAU</th>
                                    <th class="column-title">Trw 1 Pendapatan (Rp  Ribu)</th>
                                    <th class="column-title">Trw 2 Pendapatan (Rp  Ribu)</th>
                                    <th class="column-title">Trw 3 Pendapatan (Rp  Ribu)</th>
                                    <th class="column-title">Trw 4 Pendapatan (Rp  Ribu)</th>
                                    <th class="column-title">Jumlah Pendapatan (Rp  Ribu) RKAU</th>
                                    <th class="bulk-actions" colspan="8">
                                       <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                    </th>
                                 </tr>
                              </thead>

                              <tbody>
                                 @if(count($list))
                                 <?php $i = $paging['pageNo'] == 1 ? 1 : ($paging['pageNo'] * $paging['totalPerPage'] - ($paging['totalPerPage'] - 1) ) ?>
                                 @foreach($list as $row)
                                 <tr class="even pointer">
                                    <td>
                                       {{ $i++ }}
                                       <input type="hidden" name="id[]" id="token" value="{{ $row['id'] }}">
                                    </td>
                                    <td class=" ">
                                       {{ $row['tarif_code'] }} 
                                    </td>
                                    <td>
                                       @if($mode == 'edit')
                                       <input type="text" name="q1_qty_mwh[]" value="{{ $row['q1_qty_mwh'] }}"  class="form-control right">
                                       @else
                                       {{ $row['q1_qty_mwh'] }} 
                                       @endif
                                    </td>
                                    <td class=" ">
                                       @if($mode == 'edit')
                                       <input type="text" name="q2_qty_mwh[]" value="{{ $row['q2_qty_mwh'] }}"  class="form-control">
                                       @else
                                       {{ $row['q2_qty_mwh'] }} 
                                       @endif
                                    </td>
                                    <td class=" ">
                                       @if($mode == 'edit')
                                       <input type="text" name="q3_qty_mwh[]" value="{{ $row['q3_qty_mwh'] }}"  class="form-control">
                                       @else
                                       {{ $row['q3_qty_mwh'] }} 
                                       @endif
                                    </td>
                                    <td class=" ">
                                       @if($mode == 'edit')
                                       <input type="text" name="q4_qty_mwh[]" value="{{ $row['q4_qty_mwh'] }}"  class="form-control">
                                       @else
                                       {{ $row['q4_qty_mwh'] }} 
                                       @endif
                                    </td>
                                    <td class=" ">{{ $row['q1_qty_mwh'] + $row['q2_qty_mwh'] + $row['q3_qty_mwh'] + $row['q4_qty_mwh']  }}</td>
                                    <td class=" ">
                                       @if($mode == 'edit')
                                       <input type="text" name="q1_electricity_revenue[]" value="{{ $row['q1_electricity_revenue'] }}"  class="form-control">
                                       @else
                                       {{ $row['q1_electricity_revenue'] }} 
                                       @endif
                                    </td>
                                    <td class=" ">
                                       @if($mode == 'edit')
                                       <input type="text" name="q2_electricity_revenue[]" value="{{ $row['q2_electricity_revenue'] }}"  class="form-control">
                                       @else
                                       {{ $row['q2_electricity_revenue'] }} 
                                       @endif
                                    </td>
                                    <td class=" ">
                                       @if($mode == 'edit')
                                       <input type="text" name="q3_electricity_revenue[]" value="{{ $row['q3_electricity_revenue'] }}"  class="form-control">
                                       @else
                                       {{ $row['q3_electricity_revenue'] }} 
                                       @endif
                                    </td>
                                    <td class=" ">
                                       @if($mode == 'edit')
                                       <input type="text" name="q4_electricity_revenue[]" value="{{ $row['q4_electricity_revenue'] }}"  class="form-control">
                                       @else
                                       {{ $row['q4_electricity_revenue'] }} 
                                       @endif
                                    </td>
                                    <td class=" ">{{ $row['q1_electricity_revenue'] + $row['q1_electricity_revenue'] + $row['q1_electricity_revenue'] + $row['q1_electricity_revenue'] }}</td>
                                 </tr>

                                 @endforeach
                                 @else
                                 <tr>
                                    <td colspan="7"><p>No data found.</p></td>
                                 </tr>
                                 @endif

                              </tbody>
                           </table>
                        </form>
                     </div>

                     <div class="row">
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
                              <a class="btn btn-default btn-sm {!! $paging['pageNo'] == 1 ? 'disabled' : '' !!}" id="btn_prevpage" href="{!! $paging['pageNo'] == 1 ? '#' : route('rkau_page', [ 'mode' => $mode, 'page'=>($paging['pageNo']-1), 'sort'=>'', 'rp'=>'', 'search'=>$persist ]) !!}"><span class="fa fa-arrow-left">&nbsp;</span></a>
                              <input id="pageinput" class="fl btn pageinput" type="text" value="{{ $paging['pageNo'] }}" />
                              <a class="btn btn-default btn-sm {!! $paging['pageNo'] == $paging['totalPage'] ? 'disabled' : '' !!}" id="btn_nextpage" href="{!! $paging['pageNo'] == $paging['totalPage'] ? '#' : route('rkau_page', [  'mode' => $mode, 'page'=>($paging['pageNo']+1), 'sort'=>'', 'rp'=>'', 'search'=>$persist ]) !!}"><span class="fa fa-arrow-right">&nbsp;</span></a>
                           </div>
                           @endif
                        </div>
                     </div>
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
            <input type="hidden" name="urladd" id="token" value="{{ route('rkau_add') }}">
            <!--<input type="hidden" name="id" id="id" value="">-->

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
</div>