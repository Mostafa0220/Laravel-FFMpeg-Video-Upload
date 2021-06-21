<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Jobs\ConvertVideoForDownloading;
use App\Jobs\ConvertVideoForStreaming;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index(){
        $videos = Video::paginate(10);
        return view('video/index', compact('videos'));
    }
    public function fileUpload()
    {
        return view('video/fileUpload');
    }
    public function store(StoreVideoRequest $request)
    {

        $video = Video::create([
            'disk'          => 'videos_disk',
            'original_name' => $request->video->getClientOriginalName(),
            'path'          => $request->video->store('videos', 'videos_disk'),
            'title'         => $request->title,
        ]);

        $this->dispatch(new ConvertVideoForDownloading($video));
        /* $this->dispatch(new ConvertVideoForStreaming($video)); */
        return redirect('/')->with('success', 'Video uploaded successfully.');
        /* return response()->json([
            'id' => $video->id,
        ], 201); */
    }
    /**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
    public function stream($id){
        $video = Video::find ( $id );

		if (! $video) {
			return redirect('/')->with('error', 'Record not found.');
		}

        $downloadUrl = [
            [ 'label' => 'High', 'url' => Storage::disk('downloadable_videos')->url($video->id . '_high.mp4')],
            [ 'label' => 'Mid' , 'url' => Storage::disk('downloadable_videos')->url($video->id . '_mid.mp4')],
        	[ 'label' => 'Low' , 'url' => Storage::disk('downloadable_videos')->url($video->id . '_low.mp4')],


        ];
        $map['High']=Storage::disk('downloadable_videos')->url($video->id . '_high.mp4');
        $map['Mid']=Storage::disk('downloadable_videos')->url($video->id . '_mid.mp4');
        $map['Low']=Storage::disk('downloadable_videos')->url($video->id . '_low.mp4');

        //$streamUrl = Storage::disk('streamable_videos')->url($video->id . '.m3u8');

        return view('video/stream',compact('downloadUrl','map'));

    }
}
