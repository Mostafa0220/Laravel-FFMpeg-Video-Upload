@extends('base')
@section('main')
	<div class="m-b-md">
		<div class="row" >

            <div class="col-md-6">
                <div id="video-container">
                    <video id="videoplayer" width="350" controls>
                        <source src="{{ $map['High'] }}" type="video/mp4">
                    </video>
                </div>
            </div>
            <div class="col-md-6" style="margin-top:10px">
                <div class="form-group">
                    <label for="qualitypick">Video Qulality:</label>
                    <select autocomplete="off" id="qualitypick" class="qualitypick form-control" style="width:auto;"> </select>
                </div>
            </div>
        </div>


	</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<script>
    var videoDOM = '';
    var curtime = '';
    var source = '';
    var vide0 = '';

    var formats = {
        'High': '{{ $map['High'] }}',
        'Mid': '{{ $map['Mid'] }}',
        'Low': '{{ $map['Low'] }}'
    };
    $(document).ready(function() {
        for (var format in formats) {

            $('.qualitypick').append($("<option value='" + format + "'>" + format + "</option>"));
        }

        $('.qualitypick').change(function() {
            video = document.getElementById("videoplayer");
            curtime = video.currentTime;
            video.src = formats[$(this).val()];
            video.currentTime = curtime;
            video.play();
        })

    })

</script>

