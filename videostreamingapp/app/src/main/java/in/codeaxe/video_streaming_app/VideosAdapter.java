package in.codeaxe.video_streaming_app;

import android.media.MediaPlayer;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.VideoView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import java.util.List;

public class VideosAdapter extends RecyclerView.Adapter<VideosAdapter.VideoViewHolder> {
    private List<VideoList> mVideoItems;

    public VideosAdapter(List<VideoList> videoItems) {
        mVideoItems = videoItems;
    }

    @NonNull
    @Override
    public VideoViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        return new VideoViewHolder(LayoutInflater.from(parent.getContext()).inflate(R.layout.card, parent, false));
    }

    @Override
    public void onBindViewHolder(@NonNull VideoViewHolder holder, int position) {
        holder.setVideoData(mVideoItems.get(position));
    }

    @Override
    public int getItemCount() {
        return mVideoItems.size();
    }

    static class VideoViewHolder extends RecyclerView.ViewHolder {
        VideoView mVideoView;
        TextView txtTitle;
        ProgressBar mProgressBar;

        public VideoViewHolder(@NonNull View itemView) {
            super(itemView);
            mVideoView = itemView.findViewById(R.id.videoView);
            txtTitle = itemView.findViewById(R.id.txtTitle);
        }
        void setVideoData(VideoList videoItem) {
            txtTitle.setText(videoItem.getVideo_name());

            String videoURL = videoItem.getLocation();
            if (videoURL != null && !videoURL.isEmpty()) {
                try {
                    mVideoView.setVideoPath(videoURL);
                    mVideoView.setOnPreparedListener(new MediaPlayer.OnPreparedListener() {
                        @Override
                        public void onPrepared(MediaPlayer mp) {
                            mProgressBar.setVisibility(View.GONE);
                            mp.start();

                            float videoRatio = mp.getVideoWidth() / (float) mp.getVideoHeight();
                            float screenRatio = mVideoView.getWidth() / (float) mVideoView.getHeight();
                            float scale = videoRatio / screenRatio;
                            if (scale >= 1f) {
                                mVideoView.setScaleX(scale);
                            } else {
                                mVideoView.setScaleY(1f / scale);
                            }
                        }
                    });
                    mVideoView.setOnCompletionListener(new MediaPlayer.OnCompletionListener() {
                        @Override
                        public void onCompletion(MediaPlayer mp) {
                            mp.start();
                        }
                    });
                } catch (Exception e) {
                    e.printStackTrace();
                    // Handle the exception or display an error message
                }
            } else {
                // Handle the case when the videoURL is null or empty
            }
            mVideoView.setOnErrorListener(new MediaPlayer.OnErrorListener() {
                @Override
                public boolean onError(MediaPlayer mp, int what, int extra) {
                    // Handle the error
                    return true;
                }
            });
        }
    }
}