<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReferenceRequest;
use App\Http\Requests\UpdateReferenceRequest;
use App\Models\Chapter;
use App\Models\Reference;
use Carbon\Carbon;
use DemeterChain\C;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChapterController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $chapter = Chapter::query()->where('user_id', $user['id']);
        return $chapter;
    }

    public function store(StoreChapterRequest $request)
    {
        $validated_data = $request->validated();
        $chapter = new Chapter();

        try {
            foreach ($validated_data as $key => $item) {
                $chapter->{$key} = $item;
            }

            $chapter->save();
        } catch (\Exception $e) {
            dd($e);
            return false;
        }

    }

    public function update(UpdateChapterRequest $request, $id)
    {
        $chapter = Chapter::query()->where('id', '=', $id)->get();
        $validate_data = $request->validated();
        try {
            foreach ($validate_data as $key => $item) {
                $chapter->$key = $item;
            }
            $chapter->save();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function destroy(Request $request)
    {
        $chapter = Chapter::query()->where('id', '=', $request['id']);
        try {

            $chapter->delete();
        } catch (\Exception $e) {
            return false;
        }
    }
}
