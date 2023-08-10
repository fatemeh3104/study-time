<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReferenceRequest;
use App\Http\Requests\UpdateReferenceRequest;
use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferenceController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $references = Reference::query()->where('user_id', $user['id']);
        return $references;
    }

    public function store(StoreReferenceRequest $request)
    {
        $validated_data = $request->validated();
        $reference = new Reference();

        try {
            foreach ($validated_data as $key => $item) {
                $reference->{$key} = $item;
            }

            $reference->save();
        } catch (\Exception $e) {
            dd($e);
            return false;
        }

    }

    public function update(UpdateReferenceRequest $request, $id)
    {
        $reference = Reference::query()->where('id', '=', $id)->get();
        $validate_data = $request->validated();
        try {
            foreach ($validate_data as $key => $item) {
                $reference->$key = $item;
            }
            $reference->save();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function destroy(Request $request)
    {
        $reference = Reference::query()->where('id', '=', $request['id']);
        try {

            $reference->delete();
        } catch (\Exception $e) {
            return false;
        }
    }
}
