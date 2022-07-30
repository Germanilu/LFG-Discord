<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    //Add new message to channel
    public function addMessage($id,Request $request)
    {
        try {
            Log::info('Create Message');

            //Body request
            $message = $request->input('message');
            //Recover userID by token
            $userId = auth()->user()->id;
            $channel = $id;

            $newMessage = new Message();
            $newMessage->message = $message;
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
    }


    //Get all messages by channel id
    public function getAllMessagesByChannelId ($id)
    {
        try {
            Log::info('Getting All messages');

            //Recover all messages from channel $id
            $messages = Channel::find($id)->message;
            
            //To Sort messages by Desc
            $sorted = $messages->sortByDesc('created_at');
            $sorted->values()->all();

            if(!$messages){
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Message not found'
                    ]
                );
            }

            return response()->json(
                [
                    "success"=> true,
                    "message"=> 'Get all Messages',
                    "data"=> $sorted
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


    //Delete message by Id
    public function deleteMessageById($id)
    {
        try {
            Log::info('Delete Message By id');

            $userId = auth()->user()->id;
            $message = Message::query()->where('user_id', '=', $userId)->find($id);

            //If message doesn't exist..
            if(!$message){
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Message doesnt exist'
                        
                    ]
                );
            }

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

    //Edit message by is ID
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
