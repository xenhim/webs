<?php
require_once('class.cURL.php');
$curl = new cURL();
$url    = 'http://www.nettruyengo.com/';
$string = $curl->getContent($url);
preg_match('#<div class="items">(.*)id="ctl00_mainContent_ctl00_divPager"#ismU', $string, $content);
preg_match_all('#<a class="jtip".*href="(.*)">(.*)</a>#imsU', $content[1], $list_name);
$list_manga = array_combine($list_name[1], $list_name[2]);

 foreach ($list_manga as $url => $name) {
     echo $url.'<br>';
 }
/*for ($i=0; $i - $max_iterations; $i++)
{
    $proc = Start-Process -filePath $programtorun -ArgumentList $argumentlist -workingdirectory $programtorunpath -PassThru

    # keep track of timeout event
    $timeouted = $null # reset any previously set timeout

    # wait up to x seconds for normal termination
    $proc | Wait-Process -Timeout 4 -ErrorAction SilentlyContinue -ErrorVariable timeouted

    if ($timeouted)
    {
        # terminate the process
        $proc | kill

        # update internal error counter
    }
    elseif ($proc.ExitCode -ne 0)
    {
        # update internal error counter
    }
}*/

?>