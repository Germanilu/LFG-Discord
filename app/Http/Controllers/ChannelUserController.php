<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChannelUserController extends Controller
{
    const CHANNEL = 31;

    //Add user to channel
    public function addUserToChannel($id){
    
        try {
         Log::info('Add user to channel');
 
         $user = User::query()
                 ->find($id);
         $user->channel()->attach(self::CHANNEL);  

         return response()->json([
             'success' => true,
             'message' => 'Add user to channel',
             'data' => $user
         ], 200);
 
        } catch (\Exception $exception) {
         Log::error('Error Adding user to channel: ' . $exception->getMessage());

         return response()->json([
             'success' => true,
             'message' => 'Unable to Add user to channel',
             'data' => $user
         ], 500);
        }
     }
 
 
     //Remove user from channel
     public function deleteUserFromChannel($id){
         try {
          Log::info('Remove user from channel');
  
          $user = User::query()
                  ->find($id);
          $user->channel()->detach(self::CHANNEL);
          
          return response()->json([
              'success' => true,
              'message' => 'Remove user from channel',
              'data' => $user
          ], 200);
  
         } catch (\Exception $exception) {
          Log::error('Error Removing user from channel: ' . $exception->getMessage());
          
          return response()->json([
              'success' => true,
              'message' => 'Unable to Remove user from channel',
              'data' => $user
          ], 500);
         }
      }
}
