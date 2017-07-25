
<div class="container body">
   <div class="main_container">

      <!-- page content -->
      <div class="right_col" role="main">
         <div class="">
            <div class="page-title">
               <div class="title_left">
                  <h3>Macro Assumptions <small>Some examples to get you started</small></h3>
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
                     <h2>Form Upload and Data </h2>
                     <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                           <ul class="dropdown-menu" role="menu">
                              <li><a href="#">Settings 1</a>
                              </li>
                              <li><a href="#">Settings 2</a>
                              </li>
                           </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                     </ul>
                     <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                     <div class="btn-group" style="padding-bottom: 15px;">
                        <button type="button" id="doAdd" class="btn btn-success">
                           <span class="docs-tooltip" data-toggle="tooltip" title="">
                              <span class="fa fa-plus-circle"></span> Add
                           </span>
                        </button>
                        <button type="button" id="doEdit" class="btn btn-success">
                           <span class="docs-tooltip" data-toggle="tooltip" title="">
                              <span class="fa fa-pencil"></span> Edit
                           </span>
                        </button>
                        <button type="button" id="doDel" class="btn btn-success">
                           <span class="docs-tooltip" data-toggle="tooltip" title="">
                              <span class="fa fa-trash"></span> Delete
                           </span>
                        </button>
                     </div>
                     <div class="clearfix"></div>
                     <div class="table-responsive">
                        <table id="tblrowclick" class="table table-striped jambo_table bulk_action">
                           <thead>
                              <tr class="headings">
                                 <th width="15px">
                                    <input type="checkbox" id="check-all" class="flat">
                                 </th>
                                 <th class="column-title" width="20px">No </th>
                                 <th class="column-title">Nama </th>
                                 <th class="column-title">Email </th>
                                 <th class="column-title">Deleted at </th>
                                 <th class="column-title">Status </th>
                                 <th class="column-title">Amount </th>
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
                                 <td class="a-center ">
                                    <input type="checkbox" class="flat" data-id="{{ $row['id'] }}" data="{{ json_encode($row) }}" name="table_records">
                                 </td>
                                 <td>{{ $i++ }}</td>
                                 <td class=" ">{{ $row['name'] }} </td>
                                 <td class=" ">{{ $row['email'] }}</td>
                                 <td class=" ">{{ $row['deleted_at'] }}</td>
                                 <td class="a-right a-right ">$7.45</td>
                                 <td class=" last"><a href="#">View</a></td>
                              </tr>

                              @endforeach
                              @else
                              <tr>
                                 <td colspan="7"><p>No data found.</p></td>
                              </tr>
                              @endif


                           </tbody>
                        </table>
                     </div>

                     <div class="row">
                        <div class="col-sm-5">
                           <div class="pull-left">
                              <input type="hidden" id="maxpage" value="{{ $paging['totalPage'] }}" />
                              <input type="hidden" id="jumptopageinput" value="{{ route('user_page') }}" />
                              Showing {{ $paging['pageNo'] == 1 ? 1 : ($paging['pageNo'] * $paging['totalPerPage'] - ($paging['totalPerPage'] - 1) ) }} 
                              to {{$paging['pageNo']  == $paging['totalPage'] ? $paging['totalRec'] : $paging['pageNo'] * $paging['totalPerPage']}} 
                              of {{ $paging['totalRec'] }} entries</div>

                        </div>
                        <div class="col-sm-7">

                           @if(count($list))
                           <div class="btn-group  pull-right">
                              <a class="btn btn-default btn-sm {!! $paging['pageNo'] == 1 ? 'disabled' : '' !!}" id="btn_prevpage" href="{!! $paging['pageNo'] == 1 ? '#' : route('user_page', [  'page'=>($paging['pageNo']-1), 'sort'=>'', 'rp'=>'', 'search'=>$persist ]) !!}"><span class="fa fa-arrow-left">&nbsp;</span></a>
                              <input id="pageinput" class="fl btn pageinput" type="text" value="{{ $paging['pageNo'] }}" />
                              <a class="btn btn-default btn-sm {!! $paging['pageNo'] == $paging['totalPage'] ? 'disabled' : '' !!}" id="btn_nextpage" href="{!! $paging['pageNo'] == $paging['totalPage'] ? '#' : route('user_page', [  'page'=>($paging['pageNo']+1), 'sort'=>'', 'rp'=>'', 'search'=>$persist ]) !!}"><span class="fa fa-arrow-right">&nbsp;</span></a>
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
         <form id="myFormUser" method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" id="id" value="">

            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
               </button>
               <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Name <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" id="myInputFirst" name="name" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" name="email" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
               </div>
               <div class="form-group">
                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input id="middle-name" class="form-control col-md-7 col-xs-12" type="password" name="password" required="required">
                  </div>
               </div>
               <div class="form-group">
                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input id="middle-name" class="form-control col-md-7 col-xs-12" type="password" name="password_confirmation" required="required">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" class="form-control has-feedback-left" id="pickdate" name="birth_date" placeholder="">
                     <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
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