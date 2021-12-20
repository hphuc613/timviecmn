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
        //Bản đồ chuyển ngữ
        $slugTransliterationMap = [
            'á' => 'a', 'à' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a', 'â' => 'a', 'ă' => 'a', 'Á' => 'A',
            'À' => 'A',
            'Ả' => 'A',
            'Ã' => 'A',
            'Ạ' => 'A',
            'Â' => 'A',
            'Ă' => 'A',
            'ấ' => 'a',
            'ầ' => 'a',
            'ẩ' => 'a',
            'ẫ' => 'a',
            'ậ' => 'a',
            'Ấ' => 'A',
            'Ầ' => 'A',
            'Ẩ' => 'A',
            'Ẫ' => 'A',
            'Ậ' => 'A',
            'ắ' => 'a',
            'ằ' => 'a',
            'ẳ' => 'a',
            'ẵ' => 'a',
            'ặ' => 'a',
            'Ắ' => 'A',
            'Ằ' => 'A',
            'Ẳ' => 'A',
            'Ẵ' => 'A',
            'Ặ' => 'A',
            'đ' => 'd',
            'Đ' => 'D',
            'é' => 'e',
            'è' => 'e',
            'ẻ' => 'e',
            'ẽ' => 'e',
            'ẹ' => 'e',
            'ê' => 'e',
            'É' => 'E',
            'È' => 'E',
            'Ẻ' => 'E',
            'Ẽ' => 'E',
            'Ẹ' => 'E',
            'Ê' => 'E',
            'ế' => 'e',
            'ề' => 'e',
            'ể' => 'e',
            'ễ' => 'e',
            'ệ' => 'e',
            'Ế' => 'E',
            'Ề' => 'E',
            'Ể' => 'E',
            'Ễ' => 'E',
            'Ệ' => 'E',
            'í' => 'i',
            'ì' => 'i',
            'ỉ' => 'i',
            'ĩ' => 'i',
            'ị' => 'i',
            'Í' => 'I',
            'Ì' => 'I',
            'Ỉ' => 'I',
            'Ĩ' => 'I',
            'Ị' => 'I',
            'ó' => 'o',
            'ò' => 'o',
            'ỏ' => 'o',
            'õ' => 'o',
            'ọ' => 'o',
            'ô' => 'o',
            'ơ' => 'o',
            'Ó' => 'O',
            'Ò' => 'O',
            'Ỏ' => 'O',
            'Õ' => 'O',
            'Ọ' => 'O',
            'Ô' => 'O',
            'Ơ' => 'O',
            'ố' => 'o',
            'ồ' => 'o',
            'ổ' => 'o',
            'ỗ' => 'o',
            'ộ' => 'o',
            'Ố' => 'O',
            'Ồ' => 'O',
            'Ổ' => 'O',
            'Ỗ' => 'O',
            'Ộ' => 'O',
            'ớ' => 'o',
            'ờ' => 'o',
            'ở' => 'o',
            'ỡ' => 'o',
            'ợ' => 'o',
            'Ớ' => 'O',
            'Ờ' => 'O',
            'Ở' => 'O',
            'Ỡ' => 'O',
            'Ợ' => 'O',
            'ú' => 'u',
            'ù' => 'u',
            'ủ' => 'u',
            'ũ' => 'u',
            'ụ' => 'u',
            'ư' => 'u',
            'Ú' => 'U',
            'Ù' => 'U',
            'Ủ' => 'U',
            'Ũ' => 'U',
            'Ụ' => 'U',
            'Ư' => 'U',
            'ứ' => 'u',
            'ừ' => 'u',
            'ử' => 'u',
            'ữ' => 'u',
            'ự' => 'u',
            'Ứ' => 'U',
            'Ừ' => 'U',
            'Ử' => 'U',
            'Ữ' => 'U',
            'Ự' => 'U',
            'ý' => 'y',
            'ỳ' => 'y',
            'ỷ' => 'y',
            'ỹ' => 'y',
            'ỵ' => 'y',
            'Ý' => 'Y',
            'Ỳ' => 'Y',
            'Ỷ' => 'Y',
            'Ỹ' => 'Y',
            'Ỵ' => 'Y'
        ];

        //Ghép cài đặt do người dùng yêu cầu với cài đặt mặc định của hàm
        $options = array_merge([
            'delimiter'     => '-',
            'transliterate' => true,
            'replacements'  => [],
            'lowercase'     => true,
            'encoding'      => 'UTF-8'
        ], $options);

        //Chuyển ngữ các ký tự theo bản đồ chuyển ngữ
        if ($options['transliterate']) {
            $string = str_replace(array_keys($slugTransliterationMap), $slugTransliterationMap, $string);
        }

        //Nếu có bản đồ chuyển ngữ do người dùng cung cấp thì thực hiện chuyển ngữ
        if (is_array($options['replacements']) && !empty($options['replacements'])) {
            $string = str_replace(array_keys($options['replacements']), $options['replacements'], $string);
        }

        //Thay thế các ký tự không phải ký tự latin
        $string = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $string);

        //Chỉ giữ lại một ký tự phân cách giữa 2 từ
        $string = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1',
            trim($string, $options['delimiter']));

        //Chuyển sang chữ thường nếu có yêu cầu
        if ($options['lowercase']) {
            $string = mb_strtolower($string, $options['encoding']);
        }

        //Trả kết quả
        return $string;
    }
}
