<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Study;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudyController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $studies = Study::query()->where('user_id', $user['id']);
        return $studies;
    }

    public function store(StoreStudyRequest $request)
    {
        $validated_data = $request->validated();
        $study = new Study();

        try {
            foreach ($validated_data as $key => $item) {
                $study->{$key} = $item;
            }
            $study['user_id']=Auth::user('id');
            $study->save();
        } catch (\Exception $e) {
            dd($e);
            return false;
        }

    }

    public function update(UpdateStudyRequest $request, $id)
    {
        $study = Study::query()->where('id', '=', $id)->get();
        $validate_data = $request->validated();
        try {
            foreach ($validate_data as $key => $item) {
                $study->$key = $item;
            }
            $study['user_id'] = Auth::user('id');
            $study->save();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function destroy(Request $request)
    {
        $study = Study::query()->where('id', '=', $request['id']);
        try {

            $study->delete();
        } catch (\Exception $e) {
            return false;
        }
    }
}
