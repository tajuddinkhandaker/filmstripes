<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as UserRequest;

use App\Http\Requests;

use Auth;
use Storage;
use File;

// import the Intervention Image Manager Class
use Image;
use Intervention\Image\ImageManager;

class UserController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the user's profile page.
     *
     * @return Response
     */
    public function profile()
    {
        return view('user-profile')->withUser(auth()->user());
    }

    /**
     * Show the user's profile page.
     * 
     * @return Response
     */
    // sources:
    // http://stackoverflow.com/questions/30191330/laravel-5-how-to-access-image-uploaded-in-storage-within-view
    // http://image.intervention.io/api/response
	
	// Define the encoding format from one of the following formats:

	// jpg — return JPEG encoded image data
	// png — return Portable Network Graphics (PNG) encoded image data
	// gif — return Graphics Interchange Format (GIF) encoded image data
	// tif — return Tagged Image File Format (TIFF) encoded image data
	// bmp — return Bitmap (BMP) encoded image data
    public function avatar()
    {
        $manager = new ImageManager();
        $avatarFilePath = storage_path('app/avatars/') . auth()->user()->avatar;
        if(!$this->avatarExistsInStorageLocal())
            $avatarFilePath = storage_path('app/avatars/') . 'default.png';
        return $manager->make( $avatarFilePath )->response();
    }

    /**
     * Show the user's profile page.
     * 
     * @return Response
     */
    public function changeAvatar(UserRequest $request)
    {
    	if($request->hasFile('avatar'))
    	{
            $user = auth()->user();
            
    		$avatar = $request->file('avatar');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();
            File::delete(storage_path('app/avatars/') . $user->avatar);
    		Image::make($avatar)->resize(300, 300)->save(storage_path('app/avatars/') . $filename);

    		$user->avatar = $filename;
    		$user->save();
            return redirect()->route('users::profile');
    	}
    }

    /**
     * Check if local storage has the avatar.
     * 
     * @return Boolean
     */
    protected function avatarExistsInStorageLocal()
    {
        return Storage::disk('local')->exists('/avatars/' . auth()->user()->avatar);
    }
}
