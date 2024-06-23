<?php
class Helper {
    
    public static function ConvertDateTime($datetime) {
        $day = date("w", strtotime($datetime));
        $dayList = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
        $month = date("n", strtotime($datetime));
        $monthList = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return $dayList[$day] . ", " . date("j", strtotime($datetime)) . " " . $monthList[$month - 1] . " " . date("Y H:i", strtotime($datetime)); 
    }

    public static function generateRandomNumber($length = 8) {
        $characters = '123456789';
        $charactersLength = strlen($characters);
        $randomNumber = '';
        for ($i = 0; $i < $length; $i++) {
            $randomNumber .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomNumber;
    }
}
