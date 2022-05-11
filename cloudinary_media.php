<?php
require_once __DIR__ . '/vendor/autoload.php';

use Cloudinary\Asset\Image;
use Cloudinary\Asset\Video;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Api\Admin\AdminApi;
use Cloudinary\Tag\ImageTag;
use Cloudinary\Transformation\Adjust;
use Cloudinary\Transformation\Argument\Color;
use Cloudinary\Transformation\Argument\Text\FontWeight;
use Cloudinary\Transformation\AudioCodec;
use Cloudinary\Transformation\Background;
use Cloudinary\Transformation\Delivery;
use Cloudinary\Transformation\Effect;
use Cloudinary\Transformation\Format;
use Cloudinary\Transformation\Overlay;
use Cloudinary\Transformation\Reshape;
use Cloudinary\Transformation\Resize;
use Cloudinary\Transformation\Source;
use Cloudinary\Transformation\StreamingProfile;
use Cloudinary\Transformation\TextStyle;
use Cloudinary\Transformation\Transcode;
use Cloudinary\Transformation\VideoEdit;

//configuring Cloudinary SDK
Configuration::instance([
    'cloud' => [
        'cloud_name' => '',
        'api_key' => '',
        'api_secret' => ''],
    'url' => [
        'secure' => true]]);

//image upload
function uploadOurImage()
{
    /*
     * upload and use the filename as the public id
     */
    $response = (new UploadApi())->upload("nature.jpg", [
        "use_filename" => TRUE,
        "unique_filename" => FALSE]);
    //print_r($response)
}

//uploadOurImage();

function getAssetDetails()
{
    $res = (new AdminApi())->asset("nature");
    print_r($res);
}

//getAssetDetails();

/*
 * getting the HTML <img> tag
 */
function resizeOurImageHTML()
{
    $res = (new ImageTag("nature"))
        ->resize(Resize::pad()
            ->height(1280)
            ->width(852)
            ->background(Background::color(Color::RED))
        );

    print($res);
}

//resizeOurImageHTML();

/*
 * getting the URL of the image
 */
function resizeOurImageURLOnly(){
    $res = (new Image("nature"))
        ->resize(Resize::pad()
            ->height(1280)
            ->width(852)
            ->background(Background::color(Color::RED))
        );

    print($res);
}

//resizeOurImageURLOnly();

function cropOurImageHTML()
{
    $res = (new ImageTag("nature"))
        ->resize(Resize::crop()
            ->width(400)
            ->height(400)
        );

    print($res);
}

//cropOurImageHTML();

function cropOurImageURLOnly()
{
    $res = (new Image("nature"))
        ->resize(Resize::crop()
            ->width(400)
            ->height(400)
        );

    print($res);
}

//cropOurImageURLOnly();

/*
 * distort, shear, and then sharpen the image
 */
function transformOurImage(){
    $res = (new Image('nature'))
        ->reshape(Reshape::distort([20, 1650, 2000, 1705, 500, 0, 50, 0]))
        ->reshape(Reshape::shear(0.0, 35.0))
        ->adjust(Adjust::sharpen()->strength(250)
        );

    print($res);
}

//transformOurImage();

function addTextOverLay(){
    $res = (new Image('nature'))
        ->overlay(Overlay::source(
            Source::text('I am Nature', (new TextStyle('Verdana', 100))
                ->fontWeight(FontWeight::bold()))
                ->textColor(Color::WHITESMOKE)
        ));

    print($res);
}

//addTextOverLay();

function videoUpload(){
    $response = (new UploadApi())->upload('cat.mp4', [
        "use_filename" => TRUE,
        'resource_type' => 'video',/* 'tells' the SDK that this is a video resource */
        "unique_filename" => FALSE]);
    print_r($response);
}

//videoUpload();

function videoBlurEffect(){
    $res = (new Video('cat.mp4'))
        ->effect(Effect::blur()->strength(250)
        );
    print($res);
}

//videoBlurEffect();

function videoLoopEffect(){
    $res = (new Video('cat.mp4'))
        ->effect(Effect::loop()->additionalIterations(3)
        );
    print($res);
}

//videoLoopEffect();

function videoMuteAndDecelerateEffect(){
    $res = (new Video('cat.mp4'))
        ->effect(Effect::accelerate()->rate(-50))
        ->videoEdit(VideoEdit::volume(-100)
        );
    print($res);
}

//videoMuteAndDecelerateEffect();

function trimOurVideo(){
    $res = (new Video('cat.mp4'))
        ->videoEdit(VideoEdit::trim()->startOffset(6.0)
            ->endOffset(13.0));
    print($res);
}

//trimOurVideo();

function transcodeVideoFormat(){
    $res = (new Video('cat.mp4'))
        ->delivery(Delivery::format(
            Format::videoMkv())
        );

    print($res);
}

//transcodeVideoFormat();

function videoUploadEagerTransfrom(){
    $response = (new UploadApi())->upload('cat_2.mp4', [
        "use_filename" => TRUE,
        'resource_type' => 'video',
        "eager" => ["streaming_profile" => "full_hd_wifi", "format" => "m3u8"],
        "eager_async" => true,
        "unique_filename" => FALSE]);
}

//videoUploadEagerTransfrom();

function getModifiedBitrateVideo(){
    $res = (new Video('cat_2.m3u8'))
        ->transcode(Transcode::streamingProfile(
            StreamingProfile::fullHdWifi()));
    print($res);
}

//getModifiedBitrateVideo();

function modifyVideoAudio(){
    $res = (new Video('cat.mp4'))
    ->transcode(Transcode::audioFrequency(32000))
        ->transcode(Transcode::audioCodec(
            AudioCodec::mp3()));
    print($res);
}

//modifyVideoAudio();





/*
 *
 * Links needed
 1. IMAGE UPLOAD: https://cloudinary.com/documentation/upload_images
 2. get_the_details_of_a_single_resource: https://cloudinary.com/documentation/admin_api#get_the_details_of_a_single_resource
 3. transformation_reference: https://cloudinary.com/documentation/transformation_reference
 4. image_manipulation: https://cloudinary.com/documentation/php_image_manipulation
 5. Custom fonts: https://cloudinary.com/documentation/layers#custom_fonts
 6. Text_layer_options: https://cloudinary.com/documentation/layers#text_layer_options
 7. video_manipulation_and_delivery: https://cloudinary.com/documentation/video_manipulation_and_delivery#landingpage
 8. transcoding_videos_to_other_formats: https://cloudinary.com/documentation/video_manipulation_and_delivery#transcoding_videos_to_other_formats
 9. eager_transformations: https://cloudinary.com/documentation/transformations_on_upload#eager_transformations
10. af_audio_frequency: https://cloudinary.com/documentation/transformation_reference#af_audio_frequency
11. audio_transformations: https://cloudinary.com/documentation/audio_transformations
12. adaptive_bitrate_streaming: https://cloudinary.com/documentation/adaptive_bitrate_streaming


*/
?>