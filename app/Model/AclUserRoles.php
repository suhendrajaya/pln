<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AclUserRoles extends Model
{
    protected $table = 'ACL_USER_ROLES';


    public function roleName()
    {
        return $this->hasOne('App\Model\AclRoles', 'ROLE_ID', 'ID');
    }

}
