<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChannelController extends Controller
{
    public function createNewChannel ($id,Request $request)
    {
        try {
            Log::info('Create Channel');

            $name = $request->input('name');
            $userId = auth()->user()->id;

            //Esta linea es muy dudosa pero x ahora se queda
            $game = $id;

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
}
