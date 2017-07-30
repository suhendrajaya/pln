<?php
namespace App\Library\Auth;

use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Contracts\Auth\UserProvider as UserProvider;
use App\Kopassus\Persistence\Repository\CustomerRepository;
use Validator;
use Session;
use Log;

class KopassusUserProvider implements UserProvider {

    protected $model;

    public function __construct(UserContract $model)
    {
        $this->model = $model;
    }

    public function retrieveById($identifier)
    {
        if(Session::has('user')){
            return $this->getGenericUser(Session::get('user.0'));
        }
    }

    public function retrieveByToken($identifier, $token)
    {
    }

    public function updateRememberToken(UserContract $user, $token)
    {
    }

    public function retrieveByCredentials(array $credentials)
    {
        $user = null;
        if(isset($credentials['autologin']) == true){
            $user = $credentials;
            unset($user['autologin']);
            Session::push('user',$user);

        }else{
            $params = [
                'password'=> $credentials['password'],
                'remember'=> $credentials['remember']
            ];

//            $isUsingEmail = Validator::make($credentials, ['username'=>'email']);
//
//            if($isUsingEmail->fails()){
//                //Login with username
                $params = array_merge($params, ['username'=> $credentials['username'], 'using'=>'username']);
//            }else{
//                //Login with email
//                $params = array_merge($params, ['email'=> $credentials['username'], 'using'=>'email']);
//            }

            $resObj = CustomerRepository::login($params);
            if(isset($resObj->data->token)){
                // $user = [
                //     'sessionId'=> $resObj->data->token,
                //     'username'=> $resObj->data->data->username,
                //     'id'=> $resObj->data->data->userid,
                //     'email'=> $resObj->data->data->email,
                //     'user_companies_id'=> $resObj->data->data->user_companies_id,
                //     'bussiness_name'=> $resObj->data->data->bussiness_name,
                //     'company_logo'=> $resObj->data->data->company_logo,
                //     'company_type'=> isset($resObj->data->data->company_type)
                //         ? [ 'id' => $resObj->data->data->company_type->id, 'name' => $resObj->data->data->company_type->name,  ]
                //         : null,
                //     'fullname'=> $resObj->data->data->fullname,
                //     'roles'=> $resObj->data->data->roles,
                //     'permission'=> $resObj->data->data->userPermissions,
                //     'password'=> \Hash::make($params['password']),
                //     'additionalData'=>  $resObj->data->data->additionalData,
                //     'completed'=>  $resObj->data->data->completed,
                //     'photo'=>  $resObj->data->data->photo,
                //     'single_vendor_display'=> $resObj->data->data->single_vendor_display,
                //     'exclude_vat'=>  $resObj->data->data->exclude_vat
                // ];
                $userData = json_decode(json_encode($resObj->data->data),1);

                $user = [
                          'autologin'=> true,
        				          'sessionId'=> $resObj->data->token
                       ];

                foreach ($userData as $k => $v) {
                  if($k=='userid') {
                    $user['id'] = $v;
                  }
                  if($k=='userPermissions') {
                    $user['permission'] = $v;
                  }
                  $user[$k] = @$v;
                }
                $user['password'] = \Hash::make($params['password']);


                Log::info(sprintf("class:%s\tmethod:%s\t%s", get_class(), 'retrieveByCredentials', $resObj->data->data->username . ' LOGGED IN WITH : ' . json_encode($user)));

                Session::push('user',$user);
            }
        }

        return $this->getGenericUser($user);
    }

    /**
     * @param UserContract $user
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(UserContract $user, array $credentials)
    {
        return true;
    }

    /**
     * Get the generic user.
     *
     * @param  mixed  $user
     * @return \Illuminate\Auth\GenericUser|null
     */
    protected function getGenericUser($user)
    {
        if ($user !== null) {
            return new \Illuminate\Auth\GenericUser((array) $user);
        }
    }
}
