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

    public static function timeAgo($datetime, $full = false) {
        $loc = (new DateTime)->getTimezone();
        $now = new DateTime(date('y-m-d h:i:s A'));
        $now->setTimezone($loc);

        $ago = new DateTime($datetime);
        $ago->setTimezone($loc);
        
        $diff = $now->diff($ago);
    
        // Calculate weeks manually
        $weeks = floor($diff->d / 7);
        $days = $diff->d % 7;
    
        $string = array(
            'y' => 'tahun',
            'm' => 'bulan',
            'w' => 'minggu',
            'd' => 'hari',
            'h' => 'jam',
            'i' => 'menit',
            's' => 'detik',
        );
        
        $values = array(
            'y' => $diff->y,
            'm' => $diff->m,
            'w' => $weeks,
            'd' => $days,
            'h' => $diff->h,
            'i' => $diff->i,
            's' => $diff->s,
        );

        foreach ($string as $k => &$v) {
            if ($values[$k]) {
                $v = $values[$k] . ' ' . $v;
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' yang lalu' : 'baru saja';
    }

}
