# Laravel-FFMpeg-Video-Upload
Laravel Videos Upload using FFMpeg package and render it to different quality.
After that show the video based on internet speed with the option to choose quality

This project provides an integration with FFmpeg for Laravel 6.0 and higher.
[Laravel's Filesystem](http://laravel.com/docs/7.0/filesystem) handles the storage of the files.

## Your attention please

### How this library works:

This library requires a working [FFMpeg install](https://ffmpeg.org/download.html). You will need both FFMpeg and FFProbe binaries to use it.
Be sure to update the Environment variable 'FFMPEG_BINARIES' & 'FFPROBE_BINARIES' in .env file or the uploading function will not work.

## Features
* I used [laravel-ffmpeg](https://github.com/protonemedia/laravel-ffmpeg)
* Integration with [Laravel's Filesystem](http://laravel.com/docs/7.0/filesystem).
* I used three different Filesystem disks. One non-public disk to store the original uploaded video, one public disk to store a low-bitrate version of the video and another public disk to store a HLS export to do HTTP streaming. The names of these disks are videos_disk, downloadable_videos and streamable_videos.
* Built-in support for HLS.
* Built-in support for encrypted HLS (AES-128) and rotating keys (optional).
* Built-in support for concatenation, multiple inputs/outputs, image sequences (timelapse), complex filters (and mapping), frame/thumbnail exports.
* Built-in support for watermarks (positioning and manipulation).
* PHP 7.3 and higher.

# Technologies used:
- PHP Version 7.3
- Mysql Database
- [Laravel Framework 7.30.4](https://laravel.com/docs/7.x/releases)

## Quick Start

```bash
git clone https://github.com/Mostafa0220/Laravel-FFMpeg-Video-Upload.git && cd Laravel-FFMpeg-Video-Upload
cp .env.example .env
composer install

# I  use three different Filesystem disks. One non-public disk to store the original uploaded video, one public disk to store a low-bitrate version of the video and another public disk to store a HLS export to do HTTP streaming. The names of these disks are videos_disk, downloadable_videos and streamable_videos.
php artisan storage:link

# configure your key, database, etc in `.env` file
php artisan migrate --seed
php artisan serve

```

