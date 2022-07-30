<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function addMessage($id,Request $request)
    {
        try {
            Log::info('Create Message');

            //Recupero el title por body con $request
            $message = $request->input('message');
            //Recupero el userid por el token 
            $userId = auth()->user()->id;
            $channel = $id;

            //Conecto la variable con el modelo
            $newMessage = new Message();
            //Digo que el titulo de newTask es la variable $title
            $newMessage->message = $message;
            //Digo que el userid de la variable newTask es el $userId
            $newMessage->user_id = $userId;
            $newMessage->channel_id = $channel;

            $newMessage->save();
            return response()->json(
                [
                    "success"=> true,
                    "message"=> 'Message Created',
                    "data"=> $newMessage
                ],200
                );
            
        } catch (\Exception $exception) {
            
            Log::error('Error creating Message: ' .$exception->getMessage());

            return response()->json(
                [
                    "success"=> true,
                    "message"=> 'Error creating Message'
                ],500
                );
        }
        return 'Create Message';
    }



    public function getAllMessagesByChannelId ($id)
    {
        try {
            Log::info('Getting All messages');

            //Recupero los mensajes en el canal 1
            $messages = Channel::find($id)->message;

            return response()->json(
                [
                    "success"=> true,
                    "message"=> 'Get all Messages',
                    "data"=> $messages
                ],200
                );


        } catch (\Exception $exception) {
            Log::error('Error Getting All messages: ' .$exception->getMessage());

            
            return response()->json(
                [
                    "success"=> true,
                    "message"=> 'Error Getting Messages'
                ],500
                );
        }
    }




    public function deleteMessageById($id)
    {

        try {

            Log::info('Delete Message By id');

            $userId = auth()->user()->id;

            //De aqui recupero que este dato pertenece a ese usuario para q lo traiga
            $message = Message::query()->where('user_id', '=', $userId)->find($id);
            $message->delete();
            return response()->json(
                [
                    "success" => true,
                    "message" => 'Delete message by id',
                    "data" => $message

                ],
                200
            );
        } catch (\Exception $exception) {

            Log::error('Error deleting message by id: ' .$exception->getMessage());
            return response()->json(
                [
                    "success" => true,
                    "message" => 'Error Getting Your message'
                ],
                500
            );
        }
    }


    public function modifyMessageById($id, Request $request) {
        try {
            Log::info('Updating message with id: '.$id);
            $userId = auth()->user()->id;
            $message = Message::where('user_id','=',$userId)->find($id);
            if(!$message){
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'message not found'
                        
                    ]
                );
            }
            $message->message = $request->input('message');
            $message->save();
            return response()->json(
                [
                    'success' => true,
                    'message' => 'message updated',
                    'data'=> $message
                ]
            );
        }catch(\Exception $exception){
            Log::error('Error updating message: '.$exception->getMessage());
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Error updating message'
                ]
            );
        }
    }
}
