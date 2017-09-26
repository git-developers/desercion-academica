<?php

namespace BackendBundle\Twig\Extension;
use Symfony\Component\DependencyInjection\Container;

class GoogleDriveExtension extends \Twig_Extension
{
    public $container;
    const GOOGLE_FOLDER = 'application/vnd.google-apps.folder';

    private $mimeTypes = [
        'application/vnd.google-apps.audio' => 'file-audio-o',
        'application/vnd.google-apps.document' => 'file-text',
        'application/vnd.google-apps.drawing' => 'object-group',
        'application/vnd.google-apps.file' => '',
        'application/vnd.google-apps.folder' => 'folder',
        'application/vnd.google-apps.form' => '',
        'application/vnd.google-apps.fusiontable' => '',
        'application/vnd.google-apps.map' => '',
        'application/vnd.google-apps.photo' => 'image',
        'image/png' => 'image',
        'image/jpeg' => 'image',
        'image/x-icon' => 'file-image-o',
        'application/vnd.google-apps.presentation' => 'file-powerpoint-o',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'file-powerpoint-o',
        'application/vnd.google-apps.script' => 'code',
        'application/vnd.google-apps.sites' => '',
        'application/vnd.google-apps.spreadsheet' => 'file-excel-o',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'file-excel-o',
        'application/vnd.google-apps.unknown' => 'file-o',
        'application/vnd.google-apps.video' => 'file-video-o',
        'video/mp4' => 'file-video-o',
        'application/gzip' => 'file-zip-o',
        'application/x-rar' => 'file-zip-o',
        'application/x-compressed-tar' => 'file-zip-o',
        'application/pdf' => 'file-pdf-o',
        'application/msword' => 'file-word-o',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'file-word-o',
        'application/vnd.mysql-workbench-model' => 'code',
        'application/x-httpd-php' => 'code',
        'application/sql' => 'code',
        'application/vnd.ms-project' => 'code',
    ];

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('base64', array($this, 'base64Filter')),
            new \Twig_SimpleFilter('formatBytes', array($this, 'formatBytesFilter')),
            new \Twig_SimpleFilter('fileValue', array($this, 'fileValueFilter')),
            new \Twig_SimpleFilter('spanClass', array($this, 'spanClassFilter')),
            new \Twig_SimpleFilter('spanUrl', array($this, 'spanUrlFilter')),
        );
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('setIcon', [$this, 'setIconFunction'], ['is_safe' => ['html']] ),
            new \Twig_SimpleFunction('watchViewer', [$this, 'watchViewerFunction'], ['is_safe' => ['html'], 'needs_environment' => true] ),
        );
    }

    public function setIconFunction($mimeType)
    {
        $value = isset($this->mimeTypes[$mimeType]) ? $this->mimeTypes[$mimeType] : 'file';
        return '<i class="fa fa-2x fa-fw fa-'.$value.'"></i>';
    }

    public function watchViewerFunction(\Twig_Environment $twig)
    {

        return $twig->render(
            'BackendBundle:Twig/Googledrive:viewer.html.twig',
            [
                'small_text' => '',
            ]
        );
    }

    public function base64Filter($value)
    {
        return base64_encode($value);
    }

    public function formatBytesFilter($bytes, $precision = 2)
    {

        if(empty($bytes)){
            return;
        }

        $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $bytes > 0 ? floor(log($bytes, 1024)) : 0;
        return number_format($bytes / pow(1024, $power), $precision, '.', ',') . ' ' . $units[$power];
    }

    public function fileValueFilter($value)
    {
//        $value = array_replace([
//            'id' => '',
//            'name' => '',
//            'iconLink' => '',
//            'mimeType' => '',
//            'size' => '',
//        ], $value);

        $value = [
            isset($value['id']) ? $value['id'] : '',
            isset($value['name']) ? $value['name'] : '',
            isset($value['iconLink']) ? $value['iconLink'] : '',
            isset($value['mimeType']) ? $value['mimeType'] : '',
            $this->formatBytesFilter($value['size']),
        ];

        return base64_encode(json_encode($value));
    }

    public function spanClassFilter($mimeType)
    {

        if($mimeType == self::GOOGLE_FOLDER){
            return 'x-hand';
        }

        return;
    }

    public function spanUrlFilter($value)
    {
        if(isset($value['mimeType']) && ($value['mimeType'] == self::GOOGLE_FOLDER)){
            return $this->container->get('router')->generate('backend_googledrive_index', array('id' => $value['id'], 'name' => $value['name']));
        }

        return 'javascript:void(0)';
    }

    public function getName()
    {
        return 'google_drive_extension';
    }

}

