<?php
//namespace Cloudinary;
require_once __DIR__ . '/vendor/autoload.php';

//require Cloudinary\Cloudinary::class;
use Cloudinary\Asset\Image;
use Cloudinary\Asset\Video;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Api\Admin\AdminApi;
use Cloudinary\Tag\ImageTag;
use Cloudinary\Transformation\Adjust;
use Cloudinary\Transformation\Argument\Color;
use Cloudinary\Transformation\Argument\Text\FontWeight;
use Cloudinary\Transformation\Background;
use Cloudinary\Transformation\Effect;
use Cloudinary\Transformation\Overlay;
use Cloudinary\Transformation\Reshape;
use Cloudinary\Transformation\Resize;
use Cloudinary\Transformation\Source;
use Cloudinary\Transformation\TextStyle;
use Cloudinary\Transformation\VideoEdit;

//configuring Cloudinary SDK
Configuration::instance([
    'cloud' => [
        'cloud_name' => 'agusioma',
        'api_key' => '957489173493642',
        'api_secret' => 'ajh4dnXB0jjEk7-tnHd_pqNLZDY'],
    'url' => [
        'secure' => true]]);

//image upload
function uploadOurImage()
{
    //$response = (new UploadApi())->upload("nature.jpg", ["public_id" => "nature_in_cloud"]);
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

function resizeOurImageURLOnly()
{
    $res = (new Image("nature"))
        ->resize(Resize::pad()
            ->height(1280)
            ->width(852)
            ->background(Background::color(Color::RED))
        );

    print($res);
}

//resizeOurImageURLOnly()

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

function transformOurImage(){
    $res = (new Image('nature'))
        ->reshape(Reshape::distort([20, 1650, 2000, 1705, 500, 0, 50, 0]))
        ->reshape(Reshape::shear(0.0, 35.0))
        ->adjust(Adjust::sharpen()->strength(250)
        );

    print($res);
}

//distortOurImage();

function addTextOverLay(){
    $res = (new Image('nature'))
        ->overlay(Overlay::source(
            Source::text('I am Nature', (new TextStyle('Verdana', 100))
                ->fontWeight(FontWeight::bold()))
                ->textColor(Color::WHITESMOKE)
        ));


   /* ->overlay(
        Overlay::source(
            Source::text('Love', (new TextStyle('Cookie', 40))
                ->fontWeight(FontWeight::bold()))
                ->textColor(Color::rgb('F08'))
                ->transformation((new ImageTransformation())
                    ->rotate(Rotate::byAngle(20))))
            ->position((new Position())
                ->offsetX(-45)->offsetY(44)))
        ->resize(Resize::crop()->width(300)->height(250)->x(30))
        ->roundCorners(RoundCorners::byRadius(60));*/

    print($res);
}

//addTextOverLay();

function videoUpload(){
    $response = (new UploadApi())->upload('cat.mp4', [
        "use_filename" => TRUE,
        'resource_type' => 'video',
        "unique_filename" => FALSE]);
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
    //->videoEdit(VideoEdit::volume(50));
    $res = (new Video('cat.mp4'))
        ->effect(Effect::accelerate()->rate(-50))
        ->videoEdit(VideoEdit::volume(-100)
        );
    print($res);
}

//videoMuteAndDecelerateEffect();



/*
 *
 * Links needed
 1. IMAGE UPLOAD: https://cloudinary.com/documentation/upload_images
 2. get_the_details_of_a_single_resource: https://cloudinary.com/documentation/admin_api#get_the_details_of_a_single_resource
 3. transformation_reference: https://cloudinary.com/documentation/transformation_reference
 4. image_manipulation: https://cloudinary.com/documentation/php_image_manipulation
 5. Custom fonts: https://cloudinary.com/documentation/layers#custom_fonts
 6. Text_layer_options: https://cloudinary.com/documentation/layers#text_layer_options
*/
?>