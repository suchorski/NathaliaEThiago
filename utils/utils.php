<?php
	
	class Utils {

		public static function parseInt($array, $name, $default) {
			if (isset($array[$name]) && preg_match('/^\d+$/', $array[$name])) {
				return $array[$name];
			}
			return $default;
		}

		public static function parseString($array, $name, $default) {
			if (isset($array[$name])) {
				return $array[$name];
			}
			return $default;
		}

		public static function parseDate($array, $name) {
			$date = DateTime::createFromFormat('d/m/Y H:i', $array[$name]);
			return $date->format('Y-m-d H:i:s');
		}

		public static function exifRotate($filename) {
			$exif = exif_read_data($filename);
			$image = imagecreatefromstring(file_get_contents($filename));
			if (!empty($exif['Orientation'])) {
				switch ($exif['Orientation']) {
					case 2:
						imageflip($image, IMG_FLIP_HORIZONTAL);
						break;
					case 3:
						imageflip($image, IMG_FLIP_BOTH);
						break;
					case 4:
						imageflip($image, IMG_FLIP_VERTICAL);
						break;
					case 5:
						imageflip($image, IMG_FLIP_VERTICAL);
					case 6:
						$image = imagerotate($image, -90, 0);
						break;
					case 7:
						imageflip($image, IMG_FLIP_VERTICAL);
					case 8:
						$image = imagerotate($image, 90, 0); 
						break;
					default:
						break;
				}
			}
			return $image;
		}

		public static function imageResize($image, $width, $height, $percent = 90) {
			$w = imagesx($image);
			$h = imagesy($image);
			$ratio = $w / $h;
			if ($w > $h) {
				$height = $width / $ratio;
			} else {
				$width = $height * $ratio;
			}
			$img = imagecreatetruecolor($width, $height);
			imagecopyresized($img, $image, 0, 0, 0, 0, $width, $height, $w, $h);
			$stream = fopen("php://memory", "w+");
			imagejpeg($img, $stream, $percent);
			rewind($stream);
			return stream_get_contents($stream);
		}

	}
?>