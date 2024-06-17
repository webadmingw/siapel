<?php
class Helper {
    public static function ConvertDateTime($datetime) {
        $day = date("w", strtotime($datetime));
        $dayList = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
        $month = date("n", strtotime($datetime));
        $monthList = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return $dayList[$day] . ", " . date("j", strtotime($datetime)) . " " . $monthList[$month - 1] . " " . date("Y H:i", strtotime($datetime)); 
    }
}
