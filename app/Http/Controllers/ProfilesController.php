<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user) : false;

        $postCount = $user->posts ? '0' : Cache::remember(
            'count.posts.' . $user->id,
            now()->addSeconds(30),
            function ($user) {
                return $user->posts ? $user->posts->count() : '0';
            }
        );

        $followersCount = $user->profile->followers ? '0' : Cache::remember(
            'count.followers.' . $user->id,
            now()->addSeconds(30),
            function ($user) {
                return $user->profile->followers->count();
            }
        );

        $followingCount =  !$user->profile->following ? '0' : Cache::remember(
            'count.following.' . $user->id,
            now()->addSeconds(30),
            function ($user) {
                return $user->profile->following->count();
            }
        );

        return view('profiles.index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("/profile/{$user->id}");
    }
}
