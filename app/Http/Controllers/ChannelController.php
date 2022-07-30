<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChannelController extends Controller
{   

    //Creating new Channel
    public function createNewChannel ($id,Request $request)
    {
        try {
            Log::info('Create Channel');

            $name = $request->input('name');
            $userId = auth()->user()->id;

            //Getting game id
            $game = $id;

            //Validation name new Channel
            if(!$name|| $name = ""){
                return response()->json(
                    [
                        "success"=> true,
                        "message"=> 'Missing Channel Name' 
                    ],200
                    );
            }

            $newChannel = new Channel();
            $newChannel->name = $name;
            $newChannel->user_id = $userId;
            $newChannel->game_id = $game;
            $newChannel->save();

            return response()->json(
                [
                    "success"=> true,
                    "message"=> 'Channel Created',
                    "data" => $newChannel
                ],200
                );

        } catch (\Exception $exception) {
            Log::error('Error creating Channel: ' .$exception->getMessage());

            return response()->json(
                [
                    "success"=> true,
                    "message"=> 'Error creating Channel'
                ],500
                );
        }
    }


    //Get all channel
    public function getAllChannels ()
    {
        try {
            Log::info('Getting Channels');
            
            $channel = Channel::query()
                ->get()
                ->toArray();

            return response()->json(
                [
                    "success"=> true,
                    "message"=> 'Get Channels',
                    "data"=> $channel
                ],200
                );


        } catch (\Exception $exception) {
            Log::error('Error Getting All Channels: ' .$exception->getMessage());

            
            return response()->json(
                [
                    "success"=> true,
                    "message"=> 'Error Getting Channels'
                ],500
                );
        }
    }


    //Get channel by id
    public function getChannelById ($id)
    {
        try {

            Log::info('Getting Channel By id');

            $userId = auth()->user()->id;
            $channel = Channel::query()->where('user_id' , '=', $userId)->find($id);
            
            if(!$channel){
                return response()->json(
                    [
                        "success"=> true,
                        "message"=> 'Channel not found'
                        
                    ],200
                    );
            }
            

            return response()->json(
                [
                    "success"=> true,
                    "message"=> 'Get Channel by id',
                    "data" => $channel
                    
                ],200
                );
        } catch (\Exception $exception) {

            Log::error('Error Getting All Channel: ' .$exception->getMessage());
            return response()->json(
                [
                    "success"=> true,
                    "message"=> 'Error Getting Your Channel'
                ],500
                );
        }
    }

    //Delete channel by id
    public function deleteChannelById($id)
    {

        try {
            Log::info('Delete channel By id');

            $userId = auth()->user()->id;
            $channel = Channel::query()->where('user_id', '=', $userId)->find($id);
            $channel->delete();
            return response()->json(
                [
                    "success" => true,
                    "message" => 'Delete channel by id',
                    "data" => $channel

                ],
                200
            );

        } catch (\Exception $exception) {
            Log::error('Error deleting channel by id: ' .$exception->getMessage());

            return response()->json(
                [
                    "success" => true,
                    "message" => 'Error Deleting Your channel'
                ],
                500
            );
        }
    }

    //Edit channel by ID
    public function modifyChannelById($id, Request $request) {
        try {
            Log::info('Updating channel with id: '.$id);

            $userId = auth()->user()->id;
            $channel = Channel::where('user_id','=',$userId)->find($id);

            if(!$channel){
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'channel not found'
                        
                    ]
                );
            }

            $channel->name = $request->input('name');
            $channel->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'channel updated',
                    'data'=> $channel
                ]
            );

        }catch(\Exception $exception){
            Log::error('Error updating channel: '.$exception->getMessage());

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Error updating channel'
                ]
            );
        }
    }
}
