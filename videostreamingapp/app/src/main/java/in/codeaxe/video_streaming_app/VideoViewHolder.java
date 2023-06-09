package in.codeaxe.video_streaming_app;

import android.media.MediaPlayer;
import android.net.Uri;
import android.view.View;
import android.widget.VideoView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

public class VideoViewHolder extends RecyclerView.ViewHolder {

    private VideoView mVideoView;

    public VideoViewHolder(@NonNull View itemView) {
        super(itemView);
        mVideoView = itemView.findViewById(R.id.videoView);
    }

    public void bind(VideoList videoItem) {
        String videoURL = videoItem.getLocation();
        mVideoView.setVideoURI(Uri.parse(videoURL));
        mVideoView.setOnPreparedListener(MediaPlayer::start);
        mVideoView.setOnCompletionListener(MediaPlayer::start);
    }
}
