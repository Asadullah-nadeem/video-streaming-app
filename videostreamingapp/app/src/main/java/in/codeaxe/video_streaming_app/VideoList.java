package in.codeaxe.video_streaming_app;

public class VideoList {
    private String location;
    private String video_name;

    public VideoList(String location, String video_name){
        this.location = location;
        this.video_name = video_name;
    }

    public String getLocation(){
        return location;
    }

    public String getVideo_name(){
        return video_name;
    }
}
