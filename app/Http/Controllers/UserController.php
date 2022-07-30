<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    const SUPER_ADMIN_ROLE = 21;
    
    //Add superRole admin to user
    public function addRoleSuperAdminToId($id){
       try {
        Log::info('Convert into superAdmin');

        $user = User::query()
                ->find($id);
        $user->roles()->attach(self::SUPER_ADMIN_ROLE);
        
        return response()->json([
            'success' => true,
            'message' => 'Convert user to SuperAdmin',
            'data' => $user
        ], 200);

       } catch (\Exception $exception) {
        Log::error('Error converting into superAdmin: ' . $exception->getMessage());

        return response()->json([
            'success' => true,
            'message' => 'Unable to Convert to SuperAdmin',
            'data' => $user
        ], 500);
       }
    }

    //Delete superAdmin role to user
    public function deleteRoleSuperAdminToId($id){
    
        try {
         Log::info('Deleting superAdmin role');
 
         $user = User::query()
                 ->find($id);
         $user->roles()->detach(self::SUPER_ADMIN_ROLE);
         
         return response()->json([
             'success' => true,
             'message' => 'Convert super admin to user',
             'data' => $user
         ], 200);
 
        } catch (\Exception $exception) {
         Log::error('Error deleting super admin role: ' . $exception->getMessage());

         return response()->json([
             'success' => true,
             'message' => 'Unable to Convert into user',
             'data' => $user
         ], 500);
        }
     }
}
