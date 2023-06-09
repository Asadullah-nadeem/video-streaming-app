package in.codeaxe.video_streaming_app;

import java.util.List;

import retrofit2.Call;
import retrofit2.http.GET;
import retrofit2.http.Query;

public interface Api {
    @GET("api.php")
    Call<List<VideoList>> getVideos(@Query("api.php") String apiKey);
}