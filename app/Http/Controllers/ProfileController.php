<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Following;
use App\Models\Location;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function general_index()
    {
        $recommendations = Product::all()->random(5);

        return view('profile.general', [
            'recommendations' => $recommendations,
        ]);
    }

    public function general_update(Request $request)
    {
        if ($request->username != null) {
            $validated = $request->validate([
                'username' => ['required', 'unique:users', 'max:255'],
            ]);

            User::find(Auth::user()->id)->update(['username' => $request->username]);
        } else if ($request->dob != null) {
            $validated = $request->validate([
                'dob' => ['required', 'date', 'after_or_equal:1970-01-01', 'before_or_equal:2009-12-31'],
            ]);

            User::find(Auth::user()->id)->update(['dob' => $request->dob]);
        } else if ($request->gender != null) {
            $validated = $request->validate([
                'gender' => ['required', Rule::in(['Male', 'Female', 'Other']),],
            ]);

            User::find(Auth::user()->id)->update(['gender' => $request->gender]);
        } else if ($request->phone != null) {
            $validated = $request->validate([
                'phone' => ['required', 'numeric', 'digits:12'],
            ]);

            User::find(Auth::user()->id)->update(['phone' => $request->phone]);
        } else if ($request->image != null) {
            $validated = $request->validate([
                'image' => ['required', 'file', 'max:' . (10 * 1024 * 1024), 'mimes:jpg,jpeg,png'],
            ]);

            if (Auth::user()->image != null) {
                $path = str_replace('storage/', '', Auth::user()->image);
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }

            $image = Storage::disk('public')->put('user-images', $request->file('image'));
            User::find(Auth::user()->id)->update(['image' => 'storage/' . $image]);
        }

        return redirect()->back();
    }

    public function location_index()
    {
        $recommendations = Product::all()->random(5);

        return view('profile.location', [
            'recommendations' => $recommendations,
        ]);
    }

    public function location_store(Request $request)
    {
        $validated = $request->validate([
            'city' => ['required'],
            'country' => ['required'],
            'address' => ['required'],
            'notes' => ['required'],
            'postal_code' => ['required', 'numeric', 'digits:5'],
            'latitude' => ['required'],
            'longitude' => ['required'],
        ]);

        Location::create([
            'city' => $request->city,
            'country' => $request->country,
            'address' => $request->address,
            'notes' => $request->notes,
            'postal_code' => $request->postal_code,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'locationable_id' => Auth::user()->id,
            'locationable_type' => 'user',
        ]);

        return redirect()->back();
    }

    public function location_destroy($id)
    {
        Location::find($id)->delete();

        return redirect()->back();
    }

    public function history_index()
    {
        $recommendations = Product::all()->random(5);

        return view('profile.history', [
            'recommendations' => $recommendations,
        ]);
    }

    public function following_index()
    {
        $recommendations = Product::all()->random(5);

        return view('profile.following', [
            'recommendations' => $recommendations,
        ]);
    }

    public function following_store(Request $request)
    {
        $validated = $request->validate([
            'merchant_id' => ['required'],
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->followings()->create([
            'merchant_id' => $request->merchant_id,
        ]);

        return redirect()->back();
    }

    public function following_destroy(Request $request)
    {
        $validated = $request->validate([
            'merchant_id' => ['required'],
        ]);

        $user = User::findOrFail(Auth::user()->id);

        Following::where('merchant_id', $request->merchant_id)->where('user_id', $user->id)->delete();

        return redirect()->back();
    }
}
