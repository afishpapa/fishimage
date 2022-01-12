# fishimage

# 一个整理微信视频和图片的PHP工具,主要是查找视频的拍摄日期,重新命名
# 图片只是简单的截取文件名前5个字符 因为微信图片另存为的时候格式为:微信图片_20220112123123.png
# 把图片和视频放到imageFiles里面  
# 执行 php unique.php 删除重复的文件
# 执行 php index.php  会把图片/视频 分别按文件日期命名复制到/imageFile/image和/imageFile/video里面
# 然后自行整理