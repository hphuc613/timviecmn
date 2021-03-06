<?php

namespace App\AppHelpers;

use App\AppHelpers\Excel\Import;
use App\AppHelpers\Mail\SendMail;
use Exception;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Pusher\ApiErrorException;
use Pusher\Pusher;
use Pusher\PusherException;

class Helper {
    /**
     * @return mixed
     */
    public static function getRoutePrevious() {
        return app('router')->getRoutes(url()->previous())->match(app('request')->create(url()->previous()))->getName();
    }

    /**
     * @param $mail_to
     * @param $subject
     * @param $title
     * @param $body
     * @param null $template
     * @return bool
     */
    public static function sendMail($mail_to, $subject, $title, $body, $template = null) {
        /** Send email */
        if (empty($template)) {
            $template = 'Base::mail.send_test_mail';
        }
        $mail = new SendMail;
        $mail->to($mail_to)->subject($subject)->title($title)->body($body)->view($template);

        try {
            Mail::send($mail);
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * @param $string
     * @param false $associative
     * @return false|mixed
     */
    public static function isJson($string, $associative = false) {
        try {
            $string = json_decode($string, $associative);
            return $string;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @param $file
     * @return array
     */
    public static function excelImport($file) {
        /** Get array data*/
        $array = Excel::toArray(new Import, $file);
        $array = reset($array);

        /** Get header*/
        $header = $array[0];
        /** Get data*/
        unset($array[0]);
        $data = $array;

        return [
            'head' => $header,
            'data' => $data
        ];
    }

    /**
     * @param $file
     * @param $file_name
     * @param $upload_address
     * @return string
     */
    public static function storageFile($file, $file_name, $upload_address) {
        $file->storeAs('public/upload/' . $upload_address, $file_name);

        return 'storage/upload/'.$upload_address . '/' . $file_name;
    }

    /**
     * @param $string
     * @param array $options
     *
     * @return bool|false|string|string[]|null
     */
    public static function slug($string, $options = []) {
        //B???n ????? chuy???n ng???
        $slugTransliterationMap = [
            '??' => 'a', '??' => 'a', '???' => 'a', '??' => 'a', '???' => 'a', '??' => 'a', '??' => 'a', '??' => 'A',
            '??' => 'A',
            '???' => 'A',
            '??' => 'A',
            '???' => 'A',
            '??' => 'A',
            '??' => 'A',
            '???' => 'a',
            '???' => 'a',
            '???' => 'a',
            '???' => 'a',
            '???' => 'a',
            '???' => 'A',
            '???' => 'A',
            '???' => 'A',
            '???' => 'A',
            '???' => 'A',
            '???' => 'a',
            '???' => 'a',
            '???' => 'a',
            '???' => 'a',
            '???' => 'a',
            '???' => 'A',
            '???' => 'A',
            '???' => 'A',
            '???' => 'A',
            '???' => 'A',
            '??' => 'd',
            '??' => 'D',
            '??' => 'e',
            '??' => 'e',
            '???' => 'e',
            '???' => 'e',
            '???' => 'e',
            '??' => 'e',
            '??' => 'E',
            '??' => 'E',
            '???' => 'E',
            '???' => 'E',
            '???' => 'E',
            '??' => 'E',
            '???' => 'e',
            '???' => 'e',
            '???' => 'e',
            '???' => 'e',
            '???' => 'e',
            '???' => 'E',
            '???' => 'E',
            '???' => 'E',
            '???' => 'E',
            '???' => 'E',
            '??' => 'i',
            '??' => 'i',
            '???' => 'i',
            '??' => 'i',
            '???' => 'i',
            '??' => 'I',
            '??' => 'I',
            '???' => 'I',
            '??' => 'I',
            '???' => 'I',
            '??' => 'o',
            '??' => 'o',
            '???' => 'o',
            '??' => 'o',
            '???' => 'o',
            '??' => 'o',
            '??' => 'o',
            '??' => 'O',
            '??' => 'O',
            '???' => 'O',
            '??' => 'O',
            '???' => 'O',
            '??' => 'O',
            '??' => 'O',
            '???' => 'o',
            '???' => 'o',
            '???' => 'o',
            '???' => 'o',
            '???' => 'o',
            '???' => 'O',
            '???' => 'O',
            '???' => 'O',
            '???' => 'O',
            '???' => 'O',
            '???' => 'o',
            '???' => 'o',
            '???' => 'o',
            '???' => 'o',
            '???' => 'o',
            '???' => 'O',
            '???' => 'O',
            '???' => 'O',
            '???' => 'O',
            '???' => 'O',
            '??' => 'u',
            '??' => 'u',
            '???' => 'u',
            '??' => 'u',
            '???' => 'u',
            '??' => 'u',
            '??' => 'U',
            '??' => 'U',
            '???' => 'U',
            '??' => 'U',
            '???' => 'U',
            '??' => 'U',
            '???' => 'u',
            '???' => 'u',
            '???' => 'u',
            '???' => 'u',
            '???' => 'u',
            '???' => 'U',
            '???' => 'U',
            '???' => 'U',
            '???' => 'U',
            '???' => 'U',
            '??' => 'y',
            '???' => 'y',
            '???' => 'y',
            '???' => 'y',
            '???' => 'y',
            '??' => 'Y',
            '???' => 'Y',
            '???' => 'Y',
            '???' => 'Y',
            '???' => 'Y'
        ];

        //Gh??p c??i ?????t do ng?????i d??ng y??u c???u v???i c??i ?????t m???c ?????nh c???a h??m
        $options = array_merge([
            'delimiter'     => '-',
            'transliterate' => true,
            'replacements'  => [],
            'lowercase'     => true,
            'encoding'      => 'UTF-8'
        ], $options);

        //Chuy???n ng??? c??c k?? t??? theo b???n ????? chuy???n ng???
        if ($options['transliterate']) {
            $string = str_replace(array_keys($slugTransliterationMap), $slugTransliterationMap, $string);
        }

        //N???u c?? b???n ????? chuy???n ng??? do ng?????i d??ng cung c???p th?? th???c hi???n chuy???n ng???
        if (is_array($options['replacements']) && !empty($options['replacements'])) {
            $string = str_replace(array_keys($options['replacements']), $options['replacements'], $string);
        }

        //Thay th??? c??c k?? t??? kh??ng ph???i k?? t??? latin
        $string = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $string);

        //Ch??? gi??? l???i m???t k?? t??? ph??n c??ch gi???a 2 t???
        $string = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1',
            trim($string, $options['delimiter']));

        //Chuy???n sang ch??? th?????ng n???u c?? y??u c???u
        if ($options['lowercase']) {
            $string = mb_strtolower($string, $options['encoding']);
        }

        //Tr??? k???t qu???
        return $string;
    }
}
