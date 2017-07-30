<?php
namespace App\LibraryAuth;

use Auth;

class PlnAclManager 
{
 
    public function isBuyer(){
        $roleArray = json_decode(json_encode(Auth::user()->roles), true);
        $roleIds = array_column($roleArray, 'id');
        if(array_intersect(config('common.roleBelongsToBuyerGroup'), $roleIds)){
           return true;
        }else{
            return false;
        }
    }

    public function isSubdomain(){
        $subdomain = json_decode(json_encode(Auth::user()->user_companies_id), true);
        if(empty($subdomain)){
            return false;
        }
        else{
            return $subdomain;
        }
    }

    public function userSubdomain(){
        $subdomain = json_decode(json_encode(Auth::user()->group_type), true);

        switch ($subdomain) {
            case '2':
                return "lkpp";
                break;
            case '3':
                return "sampoerna";
                break;
            case '5':
                return "apl";
                break;
            default:
                return false;
        }
    }

    /**
     * Helper function to determine which user type is logged in
     * @return bool
     */
    public function isSeller(){
        $roleArray = json_decode(json_encode(Auth::user()->roles), true);
        $roleIds = array_column($roleArray, 'id');
        if(array_intersect(config('common.roleBelongsToSellerGroup'), $roleIds)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Check whether user has role
     */
    public function hasRole(array $role){
        $roleArray = json_decode(json_encode(Auth::user()->roles), true);
        $roleIds = array_column($roleArray, 'id');
        if(array_intersect($role, $roleIds)){
            return true;
        }else{
            return false;
        }
    }

    /*************************
     * ROLE SPECIFIC CHECKING
     * NOTE : This can be changed since there is no fix specification for roles
     *************************/

    public function isBuyerEproc() {
        if(self::isBuyer() && self::hasRole([3])) return true;
        return false;
    }

    public function isBuyerStaff() {
        if(self::isBuyer() && self::hasRole([4])) return true;
        return false;
    }

    public function isBuyerManager() {
        if(self::isBuyer() && self::hasRole([5])) return true;
        return false;
    }

    public function isBuyerAdmin() {
        if(self::isBuyer() && self::hasRole([6])) return true;
        return false;
    }

    public function isBuyerFinance() {
        if(self::isBuyer() && self::hasRole([7])) return true;
        return false;
    }


    public function isSellerStaff() {
        if(self::isSeller() && self::hasRole([8])) return true;
        return false;
    }

    public function isSellerManager() {
        if(self::isSeller() && self::hasRole([9])) return true;
        return false;
    }

    public function isSellerAdmin() {
        if(self::isSeller() && self::hasRole([10])) return true;
        return false;
    }

    public function isSellerFinance() {
        if(self::isSeller() && self::hasRole([11])) return true;
        return false;
    }

    /*************************
     * END - ROLE SPECIFIC CHECKING
     *************************/

    /**
     * To identify company for MatahariBiz. Because MBiz also act as man in the middle of bussiness
     * @param type $companyId
     * @return type
     */
    public function isMatahariBiz($companyId) {
        if($companyId == config('common.mbiz_comp_id')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * To get all Roles related to Buyer
     */
    public function getBuyerRoles() {
        return config('common.roleBelongsToBuyerGroup');
    }

    /**
     * To get all Roles related to Seller
     */
    public function getSellerRoles() {
        return config('common.roleBelongsToSellerGroup');
    }

    public function hasFinance()
    {
        $financeId = 7;
        $companyId = Auth::user()->user_companies_id;
        $customer = new CustomerService();
        $finance = $customer->getUsersByCompanyIdAndRole($companyId, $financeId);
        $activeFinance = array_where($finance, function ($key, $value) {
            return $value['active'] > 0;
        });
        
        $hasFinance = count($activeFinance);   

        if ($hasFinance > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function canAccessInvoiceMenu()
    {
        if (self::hasFinance() == false && self::isBuyerEproc() == true) {
            return true;
        } 

        return false;
    }
}
