<?php

namespace App\Http\Controllers;

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



    // public function getAllTasksByUserId ()
    // {
    //     try {
    //         Log::info('Getting Task');
    //         //Recupero el user ID
    //         $userId = auth()->user()->id;
    //         //El ultimo task de la linea abajo le estoy diciendo de atacar al metodo del modelo user que se llama task
    //         $tasks = User::find($userId)->tasks;

    //         return response()->json(
    //             [
    //                 "success"=> true,
    //                 "message"=> 'Get all tasks',
    //                 "data"=> $tasks
    //             ],200
    //             );


    //     } catch (\Exception $exception) {
    //         Log::error('Error Getting All tasks: ' .$exception->getMessage());

            
    //         return response()->json(
    //             [
    //                 "success"=> true,
    //                 "message"=> 'Error Getting tasks'
    //             ],500
    //             );
    //     }
    // }



    // public function getOneTasksById ($id)
    // {
    //     try {

    //         Log::info('Getting Task By id');

    //         $userId = auth()->user()->id;
    //         //De aqui recupero que este dato pertenece a ese usuario para q lo traiga
    //         $task = Task::query()->where('user_id' , '=', $userId)->find($id);
            
    //         if(!$task){
    //             return response()->json(
    //                 [
    //                     "success"=> true,
    //                     "message"=> 'Task not found'
                        
    //                 ],200
    //                 );
    //         }
            

    //         return response()->json(
    //             [
    //                 "success"=> true,
    //                 "message"=> 'Get task by id',
    //                 "data" => $task
                    
    //             ],200
    //             );
    //     } catch (\Exception $exception) {
    //         Log::error('Error Getting All tasks: ' .$exception->getMessage());

            
    //         return response()->json(
    //             [
    //                 "success"=> true,
    //                 "message"=> 'Error Getting Your Task'
    //             ],500
    //             );
    //     }
    // }



    // public function deleteOneTaskById($id)
    // {

    //     try {

    //         Log::info('Delete Task By id');

    //         $userId = auth()->user()->id;

    //         //De aqui recupero que este dato pertenece a ese usuario para q lo traiga
    //         $task = Task::query()->where('user_id', '=', $userId)->find($id);
    //         $task->delete();
    //         return response()->json(
    //             [
    //                 "success" => true,
    //                 "message" => 'Delete task by id',
    //                 "data" => $task

    //             ],
    //             200
    //         );
    //     } catch (\Exception $exception) {

    //         Log::error('Error deleting task by id: ' .$exception->getMessage());
    //         return response()->json(
    //             [
    //                 "success" => true,
    //                 "message" => 'Error Getting Your Task'
    //             ],
    //             500
    //         );
    //     }
    // }


    // public function updateOneTaskById($id, Request $request) {
    //     try {
    //         Log::info('Updating task with id: '.$id);
    //         $userId = auth()->user()->id;
    //         $task = Task::where('user_id','=',$userId)->find($id);
    //         if(!$task){
    //             return response()->json(
    //                 [
    //                     'success' => false,
    //                     'message' => 'Task not found'
                        
    //                 ]
    //             );
    //         }
    //         $task->title = $request->input('title');
    //         $task->save();
    //         return response()->json(
    //             [
    //                 'success' => true,
    //                 'message' => 'Task updated',
    //                 'data'=> $task
    //             ]
    //         );
    //     }catch(\Exception $exception){
    //         Log::error('Error updating task: '.$exception->getMessage());
    //         return response()->json(
    //             [
    //                 'success' => true,
    //                 'message' => 'Error updating task'
    //             ]
    //         );
    //     }
    // }
}
