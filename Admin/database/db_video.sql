-- Table structure for table `video`
CREATE TABLE `video` (
  `video_id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `video_name` VARCHAR(100) NOT NULL,
  `location` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Delete the video with video_id = 3
DELETE FROM `video` WHERE `video_id` = 3;
