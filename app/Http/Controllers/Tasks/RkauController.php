<?php

namespace App\Http\Controllers\Tasks;

use Illuminate\Http\Request;
use App\Http\Controllers\Tasks\WebBasedController;
use App\Model\Users;
use App\Model\SalesAddCustomer;
use Auth;
use Excel;

class RkauController extends WebBasedController
{
    private $user;
    private $maximum_upload_file;

    public function __construct()
    {
        parent::__construct();
        $this->maximum_upload_file = 10485760; //10 MB;
        $user = Auth::user();
        $this->user = $user;
    }

    public function index(Request $req)
    {
        try
        {
            $search = !$req->input('search') ? null : $req->input('search');
            $pageNo = !$req->input('page') ? 1 : $req->input('page');

            $param = [
//            'search_term' => ['name' => 'asd'],
                'order_by' => ['created_at' => 'desc'],
                'cur_page' => $pageNo,
                'total_per_page' => env('TOTAL_REC_PAGE', 10)
            ];
            $resp = SalesAddCustomer::doGet($param);



            $data = [
                'mode' => $req->input('mode'),
                'user' => $this->user,
                'list' => $resp['data'],
                'paging' => [
                    'pageNo' => (@$resp['meta']['curPage']) ? @$resp['meta']['curPage'] : 1,
                    'totalPage' => @$resp['meta']['totalPage'],
                    'totalPerPage' => env('TOTAL_REC_PAGE', 10),
                    'totalRec' => @$resp['meta']['totalRec'],
                ],
                /* set persistent search form value here */
                'persist' => $search,
            ];


            $this->theme->asset()->cook('rkau', function($asset) {
                $asset->container('footer')->usePath()->add('rkau_js', 'js/task/rkau.js');
            });

            $this->theme->asset()->serve('rkau');
            return $this->theme->scope('tasks.rkau', $data)->render();
        } catch (Exception $ex)
        {
            json_encode('Caught exception: ', $ex->getMessage(), "\n");
        }
    }

    public function detailById(Request $req)
    {
        try
        {
            $search = !$req->input('search') ? null : $req->input('search');
            $pageNo = !$req->input('page') ? 1 : $req->input('page');

            $param = [
                'order_by' => ['created_at' => 'desc'],
                'cur_page' => $pageNo,
                'total_per_page' => 1000 //env('TOTAL_REC_PAGE', 10000)
            ];
            $resp = SalesAddCustomer::doGet($param);



            $data = [
                'mode' => $req->input('mode') ? 'edit' : $req->input('mode'),
                'user' => $this->user,
                'list' => $resp['data'],
                'paging' => [
                    'pageNo' => (@$resp['meta']['curPage']) ? @$resp['meta']['curPage'] : 1,
                    'totalPage' => @$resp['meta']['totalPage'],
                    'totalPerPage' => env('TOTAL_REC_PAGE', 10),
                    'totalRec' => @$resp['meta']['totalRec'],
                ],
                /* set persistent search form value here */
                'persist' => $search,
            ];


            $this->theme->asset()->cook('rkau', function($asset) {
                $asset->container('footer')->usePath()->add('rkau_js', 'js/task/rkau.js');
            });

            $this->theme->asset()->serve('rkau');
            return $this->theme->scope('tasks.rkau_detail', $data)->render();
        } catch (Exception $ex)
        {
            json_encode('Caught exception: ', $ex->getMessage(), "\n");
        }
    }

    public function doAdd(Request $req)
    {
        $rsInsert = false;

        try
        {
            if ($req->hasFile('fileToUpload'))
            {
                $file = $req->file('fileToUpload');

                if ($file->getClientSize() > $this->maximum_upload_file)
                {
                    return array(
                        "code" => "200",
                        "status" => "fail",
                        "message" => "File too big. Maximum upload only 10MB"
                    );
                }
                $input = $req->all();

                $salesAddCust = SalesAddCustomer::where('SUBMISSION_STATUS_CODE', $input['submission_status_code'])
                    ->where('UNIT_CODE', $input['unit_code'])
                    ->where('YEAR_CODE', $input['year_code'])
                    ->where('VERSION_CODE', $input['version_code']);

                if ($salesAddCust->count() > 0)
                {
                    $salesAddCust->delete();
                }

                config(['excel.import.startRow' => 8]);
                $reader = Excel::load($file, function($reader) {
                        
                    })->get();
                $ins = [];
                $results = $reader->toArray();
                foreach ($results as $val)
                {
                    $ins[] = [
                        'GROUP_REVIEWER_CODE' => $this->user->id,
                        'GROUP_CONTRIBUTOR_CODE' => 'code',
                        'submission_status_code' => $input['submission_status_code'],
                        'unit_code' => $input['unit_code'],
                        'year_code' => $input['year_code'],
                        'version_code' => $input['version_code'],
                        'tarif_code' => $val['tarif_code'],
                        'Q1_QTY_MWH' => $val['trw_1_penjualan_mwh'],
                        'Q2_QTY_MWH' => $val['trw_2_penjualan_mwh'],
                        'Q3_QTY_MWH' => $val['trw_3_penjualan_mwh'],
                        'Q4_QTY_MWH' => $val['trw_4_penjualan_mwh'],
//                            'jumlah_penjualan_mwh_rkau' => $val['trw_1_penjualan_mwh'] + $val['trw_2_penjualan_mwh'] + $val['trw_3_penjualan_mwh'] + $val['trw_4_penjualan_mwh'],
                        'Q1_ELECTRICITY_REVENUE' => $val['trw_1_pendapatan_rp_ribu'],
                        'Q2_ELECTRICITY_REVENUE' => $val['trw_2_pendapatan_rp_ribu'],
                        'Q3_ELECTRICITY_REVENUE' => $val['trw_3_pendapatan_rp_ribu'],
                        'Q4_ELECTRICITY_REVENUE' => $val['trw_4_pendapatan_rp_ribu'],
                        'HARGA_JUAL_RWH' => $val['harga_jual_rpkwh_rkau'],
//                            'jumlah_pendapatan_rp_ribu_rkau' => $val['Q1_ELECTRICITY_REVENUE'] + $val['Q2_ELECTRICITY_REVENUE'] + $val['Q3_ELECTRICITY_REVENUE'] + $val['Q4_ELECTRICITY_REVENUE'],
//                            'harga_jual_rpkwh_rkau' => $val['harga_jual_rpkwh_rkau']
                    ];
                }

                $rsInsert = SalesAddCustomer::insert($ins);


                return array(
                    "code" => "200",
                    "status" => ($rsInsert ? "success" : "fail" )
                );
            }
            else
            {
                return array(
                    "code" => "200",
                    "status" => "fail",
                    "message" => "Please select a file"
                );
            }
        } catch (Exception $ex)
        {
            json_encode('Caught exception: ', $ex->getMessage(), "\n");
        }
    }

    public function doSave(Request $req)
    {
        try
        {
            $input = $req->all();

            if ($input)
            {
                for ($i = 0; $i < count($input['id']); $i++)
                {
                    $salcus = SalesAddCustomer::find($input['id'][$i]);
                    $salcus->q1_qty_mwh = $input['q1_qty_mwh'][$i];
                    $salcus->q2_qty_mwh = $input['q2_qty_mwh'][$i];
                    $salcus->q3_qty_mwh = $input['q3_qty_mwh'][$i];
                    $salcus->q4_qty_mwh = $input['q4_qty_mwh'][$i];
                    $salcus->q1_electricity_revenue = $input['q1_electricity_revenue'][$i];
                    $salcus->q2_electricity_revenue = $input['q2_electricity_revenue'][$i];
                    $salcus->q3_electricity_revenue = $input['q3_electricity_revenue'][$i];
                    $salcus->q4_electricity_revenue = $input['q4_electricity_revenue'][$i];
                    $salcus->harga_jual_rwh = $input['harga_jual_rwh'][$i];
                    $salcus->save();
                }

                return array(
                    "code" => "200",
                    "status" => "success"
                );
            }
            else
            {
                return array(
                    "code" => "200",
                    "status" => "fail",
                    "message" => "Please select a file"
                );
            }
        } catch (Exception $ex)
        {
            json_encode('Caught exception: ', $ex->getMessage(), "\n");
        }
    }

}
