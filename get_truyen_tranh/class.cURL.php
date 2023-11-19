<?php 

class cURL 
{
	private $site;
	private $url;
	private $path;
	protected static $header = [];


	public function __construct()
	{
	}

	private function setUrl($url)
	{
		$this->url = $url;
	}
	
	public function getUrl()
	{
		return $this->url;
	}

	public function getSite()
	{
		return $this->site;
	}

	private function pathCookie($url)
	{
		$this->setUrl($url);
		$this->site = $this->sliceSite($url);
		if ($this->site) {
			if (!file_exists(dirname(__FILE__).'/cookies/'. $this->site . '.txt')) {
				$thisFile = fopen(dirname(__FILE__).'/cookies/'. $this->site . '.txt', 'w+');
				if (!$thisFile) throw new Exception("Không thể tạo file!");
			}
			if (is_file(dirname(__FILE__).'/cookies/'. $this->site . '.txt')) {
				$this->path = dirname(__FILE__).'/cookies/'. $this->site . '.txt';
			}
			
		}
	}
	public function slug($str)
    {

        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = str_replace(" ", "-", $str);
        $str = str_replace("_", "-", $str);
        $str = str_replace(".", "-", $str);
        $str = str_replace(":", "-", $str);
        $str = str_replace("/", "-", $str);
        $str = preg_replace('/[^A-Za-z0-9\-._]/', '', $str); // Removes special chars.
        $str = preg_replace('/-+/', '-', $str);

        $str = strtolower($str);
        return $str;
    }
	public function koDau($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = str_replace(" ", "-", $str);
        $str = strtolower($str);
        return $str;
    }
	protected function setHeader($header = [])
	{
		if (count($header)) {
			foreach ($header as $key => $value) {
				self::$header[] = $value;
			}
		}
		return $this;
	}

	public function curlBot($url, $redirect = 2) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, "Google Mozilla/5.0 (compatible; Googlebot/2.1;)");
        if ($redirect) {
        	curl_setopt($ch, CURLOPT_MAXREDIRS, $redirect);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, "http://www.google.com/bot.html");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5000);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5000);
        $result = curl_exec($ch);
        return $result;
	}

	public function getContent($url, $header = [], $updateCookie = 0)
	{
		if ($header) {
			$this->setHeader($header);
		}
		$this->pathCookie($url);

		$ch = @curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, self::$header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		($this->path ? curl_setopt($ch, CURLOPT_COOKIEFILE, $this->path) : '');
		($updateCookie ? curl_setopt($ch, CURLOPT_COOKIEJAR, $this->path) : '');
		curl_setopt($ch, CURLOPT_TIMEOUT, 9999);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 9999);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		$page = curl_exec($ch);
		curl_close($ch);
		return $page;
	}

	public function postContent($url, $data = '', $header = [])
	{
		$this->pathCookie($url);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36');
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->header);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $this->path);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $this->path);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 9999);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 9999);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		$return = curl_exec($ch);
		curl_close($ch);
		return $return;
	}


	private function sliceSite($url) {
		preg_match('/https?:\/\/(?:www\.)?(.+?)\./is', $url, $domainName);
		if ($domainName) {
			return $domainName[1];
		}

	}
}