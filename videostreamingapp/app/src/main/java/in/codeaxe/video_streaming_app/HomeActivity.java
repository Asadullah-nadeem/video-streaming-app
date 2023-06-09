package in.codeaxe.video_streaming_app;

import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;

import androidx.viewpager2.widget.ViewPager2;

import java.util.ArrayList;
import java.util.List;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;
public class HomeActivity extends AppCompatActivity {

    private VideosAdapter adapter;
    private ArrayList<VideoList> videoList;
    private String url = "https://codeaxe.in/";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);

        final ViewPager2 videosViewPager = findViewById(R.id.viewPagerVideos);
        videoList = new ArrayList<>();
        adapter = new VideosAdapter(videoList);
        videosViewPager.setAdapter(adapter);

        loadData();
    }

    private void loadData() {
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl(url)
                .addConverterFactory(GsonConverterFactory.create())
                .build();

        Api apiService = retrofit.create(Api.class);
        Call<List<VideoList>> call = apiService.getVideos(url);
        call.enqueue(new Callback<List<VideoList>>() {
            @Override
            public void onResponse(Call<List<VideoList>> call, Response<List<VideoList>> response) {
                if (response.isSuccessful()) {
                    List<VideoList> videoLists = response.body();
                    if (videoLists != null) {
                        videoList.clear();
                        videoList.addAll(videoLists);
                        adapter.notifyDataSetChanged();
                    }
                }
            }

            @Override
            public void onFailure(Call<List<VideoList>> call, Throwable t) {
                // Handle API call failure
            }
        });
    }
}
