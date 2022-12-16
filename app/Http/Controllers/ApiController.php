<?php

namespace App\Http\Controllers;

use App\Jobs\FileGenerateJob;
use App\Models\Folder;
use App\Models\Note;
use App\Models\User;
use App\Traits\AppResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PDF;
class ApiController extends Controller
{
    use AppResponse;
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->FailedResponse('Invalid',401);
        }
        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
          return $this->SuccessResponse([
              'token' => $token,
              'type' => 'Bearer']
              ,200);


    }
    public function folder(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name'=>'required|unique:folders',
        ]);
        if ($validation->fails()) {
            $errors = $validation->errors();
            return $this->FailedResponse($errors,402);
        }
        $data=$request->toArray();
        $data['user_id']=\auth()->user()->getAuthIdentifier();
        $folder=Folder::Create($data);
        if($folder){
            Storage::disk('public')->makeDirectory($folder->name, 777);
        }
        return $this->SuccessResponse($folder,201);
    }
    public function note(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name'=>'required|unique:notes',
            'body'=>'required',
            'folder_id'=>'required|exists:folders,id',
        ]);
        if ($validation->fails()) {
            $errors = $validation->errors();
            return $this->FailedResponse($errors,402);
        }

        $data=$request->toArray();
        $data['user_id']=\auth()->user()->getAuthIdentifier();
        $note=Note::Create($data);
        if($note){
            $job = (new FileGenerateJob($note));
            dispatch($job);
        }
        return $this->SuccessResponse($note,201);
    }
    public function allNotes()
    {
        $note=Note::paginate(10);
        return $this->SuccessResponse($note,201);
    }
    public function private()
    {
        $user=\auth()->user();
        $note=Note::where('user_id',$user->getAuthIdentifier())->paginate(10);
        return $this->SuccessResponse($note,201);
    }
}
