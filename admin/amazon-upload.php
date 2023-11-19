<?php
class MangaAmazonUpload {

    public $options;
    public $bucket;
    public $bucket_region;
    public $buckets_regions = array();
    public $buckets;
    private $inited = false;
    private $args;

    public function __construct($config) {
        $this->options = $config;
        $this->s3_init();
    }
	
    function amazon_s3_chapter_images_url($pages){
        if(isset($this->options['amazon_s3_cdn']) && $this->options['amazon_s3_cdn'] != ''){
            $bucket = $this->options['amazon_s3_bucket'] ?? '';
            $region = $this->options['amazon_s3_region'] ?? '';

            $urls = array();

            foreach($pages as $image){
                $src = str_replace(trim(str_replace('https://', '', $this->constructS3Prefix($bucket, $region)),"/"), $this->options['amazon_s3_cdn'], $image['src']);
                $urls[] = array('src'=> $src, 'mime' => $image['mime']);
            }

            return $urls;
        }

        return $pages;
    }

    private function constructS3Prefix($bucket, $region) {
        return "https://" . $bucket . (($region && $region != 'us-east-1') ? (".s3." . $region) : '.s3') . ".amazonaws.com/";
    }
	

    private function get_args( $name = null ){

        if( ! isset( $this->args ) ){
            $options = get_option( 'wp_manga', array() );

            $this->args = apply_filters('amazon_s3_args', array(
                'credentials' => array(
                    'key'    => isset( $options['amazon_s3_access_key'] ) ? $options['amazon_s3_access_key'] : null,
                    'secret' => isset( $options['amazon_s3_access_secret'] ) ? $options['amazon_s3_access_secret'] : null,
                ),
                'version'  => 'latest',
                'bucket'   => isset( $options['amazon_s3_bucket'] ) ? $options['amazon_s3_bucket'] : null,
                'endpoint' => 's3.amazonaws.com',
                'region'   => isset( $options['amazon_s3_region'] ) ? $options['amazon_s3_region'] : '',
            ) );

            if( ! isset( $this->args['endpoint'] ) ){
                $this->args['endpoint'] = 's3.amazonaws.com';
            }elseif( $this->args['endpoint'] !== 's3.amazonaws.com' ){ //clean the endpoint if it's changed to another endpoint
                $this->args['endpoint'] = rtrim( str_replace(
                    array( 'https://', 'http://' ),
                    array( '', '' ),
                    $this->args['endpoint']
                ), '/' );
            }

        }

        if( $name ){
            return isset( $this->args[ $name ] ) ? $this->args[ $name ] : null;
        }

        return $this->args;
    }

    private function s3_init(){
        if( ! $this->inited ){
            require_once 'lib/amazons3/S3Request.php';
            require_once 'lib/amazons3/S3Exception.php';
            require_once 'lib/amazons3/S3.php';

            $credentials = $this->get_args('credentials');

            new S3(
                $credentials['key'],
                $credentials['secret'],
                $useSSL = true,
                $this->get_args('endpoint'),
                $this->get_args('region')
            );

            $this->inited = true;
        }
    }

    /**
     * Get all available buckets
     * @return array of buckets names
     */
    function amazon_get_buckets() {
        if( ! isset( $this->buckets ) ){
            try{
                $this->buckets = S3::listBuckets();
            } catch (\Throwable $th) {
                /**
                 * Try to search the correct region from error message
                 */
                $regex = sprintf( '/the region \'%s\' is wrong; expecting \'([\w|\d|\-]+)\'/', S3::getRegion() );
                preg_match( $regex, $th->getMessage(), $matches );

                if( isset( $matches[1] ) ){
                    S3::setRegion( $matches[1] );
                    $this->buckets = S3::listBuckets();
                    return $this->buckets;
                }

                throw $th;
            }

        }
        return $this->buckets;
    }

    function get_upload_bucket() {

        $buckets = $this->amazon_get_buckets();

        if( is_array( $buckets ) ){
            $bucket = $this->get_args('bucket');

            if( ! $bucket || ! in_array( $bucket, $buckets ) ){
                $bucket = $buckets[0];
            }

            $bucket_region = $this->get_bucket_region( $bucket );

            /**
             * check if current region in setting is correct
             * get_bucket_region() returns 'US' as default if it could get the bucket region, in that case, it should be ignored
             */
            if( $bucket_region !== 'US' && $bucket_region !== $this->get_args('region') ){
                $wp_manga_options = get_option( 'wp_manga' );
                $wp_manga_options['amazon_s3_region'] = $bucket_region;
                update_option( 'wp_manga', $wp_manga_options );
            }

            return $bucket;
        }

        return false;

    }

    function get_bucket_region( $bucket ){

        if( ! isset( $this->buckets_regions[ $bucket ] ) ){
            try{
                $region = S3::getBucketLocation( $bucket );
                if( $region === 'US' ){
                    $region = $this->args['region'];
                }

                $this->buckets_regions[ $bucket ] = $region;
            } catch (\Throwable $th) {

                /**
                 * Try to search the correct region from error message
                 */
                $regex = sprintf( '/the region \'%s\' is wrong; expecting \'([\w|\d|\-]+)\'/', S3::getRegion() );
                preg_match( $regex, $th->getMessage(), $matches );

                if( isset( $matches[1] ) ){
                    $this->buckets_regions[ $bucket ] = $matches[1];
                }else{
                    throw $th;
                }

            }
        }

        return $this->buckets_regions[ $bucket ];
    }

    /**
     * Flag start working with bucket
     */
    function start_working_with_bucket( $bucket ){
        $this->backup_region = S3::getRegion();
        $this->bucket_region = $this->get_bucket_region( $bucket );
        S3::setRegion( $this->bucket_region );
    }

    /**
     * Flag end working with bucket
     */
    function end_working_with_bucket(){
        if( isset( $this->backup_region ) ){
            S3::setRegion( $this->backup_region );
        }
        $this->backup_region = null;
    }

    function amazon_upload( $upload ) {

        $bucket = $this->get_upload_bucket();

        $result = array();

        if ( $bucket ) {

                // flag working with bucket session
                $this->start_working_with_bucket( $bucket );

                $upload_files = array();

                // loop through file to check existance first
                foreach ( $upload['file'] as $file ) {
                    $dir = $upload['dir'] . $file;

                    if( ! file_exists( $dir ) ){
                        $result['error'] = __('Images do not exist', WP_MANGA_TEXTDOMAIN);
                        return $result;
                    }

                    $upload_files[] = $dir;
                }

                global $wp_manga_storage;

                $chapter_path = $wp_manga_storage->get_uniq_dir_slug( $upload['chapter'] );

                foreach( $upload_files as $file ){

                    $file_path = $upload['uniqid'] . '/' . $chapter_path . '/' . basename( $file );

                    if( $this->image_upload( $file, $file_path ) ){
                        $result[] = $this->get_image_url( $bucket, $this->bucket_region, $file_path );
                    }

                }

                $this->end_working_with_bucket();

            return $result;

        } else {
            $result['error'] = __('You do not have any Amazon Buckets. Please create one and configure in WP Manga Storage page', WP_MANGA_TEXTDOMAIN);
            return $result;
        }
    }

    /**
     * Upload single file to S3
     * @param $file - string - absolute path of upload file
     * @param $name - string - absolute path and file name to put on S3
     */
    function image_upload( $file, $name ) {
        return S3::putObjectFile(
            $file,
            $this->get_upload_bucket(),
            $name,
            S3::ACL_PUBLIC_READ
        );
    }

    /**
     * Return URL of file after upload successful
     * @param $file_path - string - path of file in S3
     */
    function get_image_url( $bucket, $region, $file_path ){
        return sprintf(
            '%s/%s',
            untrailingslashit(
                apply_filters(
                    'amazon_s3_prefix_bucket',
                    "https://" . $bucket . (($region && $region != 'us-east-1') ? (".s3." . $region) : ".s3") . ".amazonaws.com/",
                    $region,
                    $bucket
                )
            ),
            $file_path
        );
    }

    function get_folder_images( $url ){

        preg_match( apply_filters('amazon_s3_cloud_folder_path_validate','/s3\/buckets\/(.+)\/\?region/'), $url, $matches );

        if( isset( $matches[1] ) ){
            $path = $matches[1];
        }else{
            return new WP_Error( '404', 'Invalid AmazonS3 Folder URL' );
        }

        $paths = explode( '/', $path );

        $bucket = $paths[0];
        unset( $paths[0] );
        $path = implode( '/', $paths );

        try {

            $output = array();

            $results = $this->list_files( $bucket, $path );

            $prefix = untrailingslashit( $this->get_image_url( $bucket, $this->get_bucket_region( $bucket ), '' ) );

            foreach( $results as $object ) {
                $output[] = "{$prefix}/{$object['name']}";
            }

            return $output;

        } catch (S3Exception $e) {
            return new WP_Error( '404', $e->getMessage() );
        }

    }

    function list_files( $bucket, $path ){
        $this->start_working_with_bucket( $bucket );
        $results = S3::getBucket( $bucket, $path );
        $this->end_working_with_bucket( $bucket );
        return $results;
    }

    function delete_amazon_s3_files( $args ){
        $options = get_option( 'wp_manga', array() );
        if(isset($options['amazon_s3_bucket'])){
            extract( $args );

            if( isset( $storage ) && is_array( $storage ) && isset( $storage['amazon'] ) ){
                if( isset( $storage['amazon'][1]['src'] ) ){
                    $url = $storage['amazon'][1]['src'];

                    $patterns = apply_filters( 'amazon_s3_file_url_validate', array(
                        array(
                            'example'   => 'https://{bucket}.s3.amazonaws.com/{file_path}',
                            'regex'     => '/^https:\/\/([^\/]+)\.s3\.amazonaws\.com\/(.+)$/',
                            'positions' => array( //index of element in $matches
                                'bucket'    => 1,
                                'file_path' => 2,
                            )
                        ),
                        array(
                            'example'   => 'https://{bucket}.s3-{region}.amazonaws.com/{file_path}',
                            'regex'     => '/^https:\/\/([^\/]+)\.s3-([\w-]+)\.amazonaws\.com\/(.+)$/',
                            'positions' => array( //index of element in $matches
                                'bucket'    => 1,
                                'region'    => 2,
                                'file_path' => 3,
                            )
                        ),
                        array(
                            'example'   => 'https://{bucket}.s3.{region}.amazonaws.com/{file_path}',
                            'regex'     => '/^https:\/\/([^\/]+)\.s3.([\w-]+)\.amazonaws\.com\/(.+)$/',
                            'positions' => array( //index of element in $matches
                                'bucket'    => 1,
                                'region'    => 2,
                                'file_path' => 3,
                            )
                        ),
                        array(
                            'example'   => 'https://s3.amazonaws.com/{bucket}/{file_path}',
                            'regex'     => '/^https:\/\/s3\.amazonaws\.com\/([^\/]+)\/(.+)$/',
                            'positions' => array( //index of element in $matches
                                'bucket'    => 1,
                                'file_path' => 2,
                            )
                        ),
                        array(
                            'example'   => 'https://s3-{region}.amazonaws.com/{bucket}/{file_path}',
                            'regex'     => '/^https:\/\/s3-([\w-]+)\.amazonaws\.com\/([^\/]+)\/(.+)$/',
                            'positions' => array( //index of element in $matches
                                'bucket'    => 2,
                                'region'    => 1,
                                'file_path' => 3,
                            )
                        )
                    ) );

                    foreach( $patterns as $pattern ){

                        preg_match( $pattern['regex'], $url, $matches );

                        if( count( $matches ) !== 4 ){
                            continue;
                        }else{
                            $bucket       = $matches[ $pattern['positions']['bucket'] ];
                            $file_path    = $matches[ $pattern['positions']['file_path'] ];
                            $chapter_path = dirname( $file_path );

                            $this->start_working_with_bucket( $bucket );
                            $chapter_files = $this->list_files( $bucket, $chapter_path );

                            if( $chapter_files ){
                                foreach( $chapter_files as $chapter_file ){
                                    S3::deleteObject( $bucket, $chapter_file['name'] );
                                }
                            }

                            S3::deleteObject( $bucket, $chapter_path );

                            $this->end_working_with_bucket();

                            return true;
                        }
                    }
                }
            }
        }

    }
}
    function setOption($key, $value) {
        $this->options[$key] = $value;
    }

    function getOption($key) {
        return isset($this->options[$key]) ? $this->options[$key] : null;
    }


// Khởi tạo lớp với cấu hình ban đầu
$config = [
    'amazon_s3_access_key' => 'AKIAWE5VWFXW4HIFVBOS',
    'amazon_s3_access_secret' => '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',
    'amazon_s3_bucket' => 'projectxemtruyens3bucket',
    'amazon_s3_region' => 'ap-southeast-1',
    // ... bất kỳ cấu hình nào khác bạn muốn đặt ...
];

$amazonUploader = new MangaAmazonUpload($config);

