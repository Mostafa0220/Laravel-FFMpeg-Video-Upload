<?php

namespace App\Jobs;

use App\Video;
use Carbon\Carbon;
use FFMpeg;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ConvertVideoForDownloading implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $video;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // create a video format...

        $lowBitrateFormat  = (new X264)->setKiloBitrate(100);
        $midBitrateFormat  = (new X264)->setKiloBitrate(1500);
        $highBitrateFormat = (new X264)->setKiloBitrate(3000);
        /* lowBitrateFormat */
        // open the uploaded video from the right disk...
        FFMpeg::fromDisk($this->video->disk)
            ->open($this->video->path)

        // add the 'resize' filter...
            /* ->addFilter(function ($filters) {
                $filters->resize(new Dimension(960, 540));
            }) */

        // call the 'export' method...
            ->export()

        // tell the MediaExporter to which disk and in which format we want to export...
            ->toDisk('downloadable_videos')
            ->inFormat($lowBitrateFormat)

        // call the 'save' method with a filename...
            ->save($this->video->id . '_low.mp4');


        /* MidBitrateFormat */
        // open the uploaded video from the right disk...
        FFMpeg::fromDisk($this->video->disk)
        ->open($this->video->path)

    // add the 'resize' filter...
        /* ->addFilter(function ($filters) {
            $filters->resize(new Dimension(960, 540));
        }) */

    // call the 'export' method...
        ->export()

    // tell the MediaExporter to which disk and in which format we want to export...
        ->toDisk('downloadable_videos')
        ->inFormat($midBitrateFormat)

    // call the 'save' method with a filename...
        ->save($this->video->id . '_mid.mp4');
    /* HighBitrateFormat */
            // open the uploaded video from the right disk...
            FFMpeg::fromDisk($this->video->disk)
            ->open($this->video->path)

        // add the 'resize' filter...
            /* ->addFilter(function ($filters) {
                $filters->resize(new Dimension(960, 540));
            }) */

        // call the 'export' method...
            ->export()

        // tell the MediaExporter to which disk and in which format we want to export...
            ->toDisk('downloadable_videos')
            ->inFormat($highBitrateFormat)

        // call the 'save' method with a filename...
            ->save($this->video->id . '_high.mp4');
        // update the database so we know the convertion is done!
        $this->video->update([
            'converted_for_downloading_at' => Carbon::now(),
        ]);
    }
}
