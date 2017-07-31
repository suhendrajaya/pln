<?php

namespace App\Http\Controllers\Tasks;

use Illuminate\Http\Request;
use App\Http\Controllers\Tasks\WebBasedController;
use App\Model\Users;
use App\Model\SalesAddCustomer;
use Auth;
use Excel;

class DashboardController extends WebBasedController
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

}
