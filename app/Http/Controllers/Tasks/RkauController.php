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
                'total_per_page' => 100
            ];
            $resp = SalesAddCustomer::doGet($param);

//            echo '<pre>';
//            print_r($resp['data']);
//            exit;

            $data = [
                'mode' => $req->input('mode'),
                'user' => $this->user,
                'list' => $resp['data'],
                'paging' => [
                    'pageNo' => (@$resp['meta']['curPage']) ? @$resp['meta']['curPage'] : 1,
                    'totalPage' => @$resp['meta']['totalPage'],
                    'totalPerPage' => 100,
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
            echo '<pre>';
            print_r($resp['data']);
            exit;
            $data = [
                'id' => 665,
                'mode' => $req->input('mode') == 'grid' ? 'grid' : 'edit',
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

                $salesAddCust = SalesAddCustomer::where('UNIT_ID', $this->user->unit_id)
                    ->where('YEAR', date('Y'));

                if ($salesAddCust->count() > 0)
                {
                    $salesAddCust->delete();
                }

                config(['excel.import.startRow' => 3]);
                $reader = Excel::load($file, function($reader) {
                        
                    })->get();
                $ins = [];
                $results = $reader->toArray();


                foreach ($results as $val)
                {

                    if (is_numeric($val['a']))
                    {
                        $ins[] = [
                            'UNIT_ID' => $this->user->unit_id,
                            'YEAR' => date('Y'),
                            'ORDER_ID' => $val['a'],
                            'ORDER_GROUP_ID' => $val['b'],
                            'TARIF_CODE1' => $val['c'],
                            'TARIF_CODE2' => $val['d'],
                            'PJL_Q1' => $val['e'],
                            'PJL_Q2' => $val['f'],
                            'PJL_Q3' => $val['g'],
                            'PJL_Q4' => $val['h'],
                            'PJL_SUM' => $val['i'],
                            'PDP_Q1' => $val['j'],
                            'PDP_Q2' => $val['k'],
                            'PDP_Q3' => $val['l'],
                            'PDP_Q4' => $val['m'],
                            'PDP_SUM' => $val['n'],
                            'SELLING_PRICE' => $val['o'],
                            'UPLOADBY_ID' => $this->user->id,
                            'UPLOADBY_NAME' => $this->user->name,
                            'CREATED_AT' => date('Y-m-d G:i:s'),
                            'UPDATED_AT' => date('Y-m-d G:i:s'),
                        ];
                    }
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

    public function getDownload()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = public_path() . "/files/penjualan.xlsx";

//        $headers = array(
//            'Content-Type: application/octet-stream',
//        );

        return Response()->download($file, 'penjualan.xlsx');
    }

}
