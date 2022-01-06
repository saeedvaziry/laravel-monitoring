<?php

/**
 * @param $duration
 * @return string
 */
function get_date_duration($duration = null)
{
    if ($duration == 'hour') {
        return 'mod(minute(created_at),5) = 0';
    }

    return 'PT1H';
}

/**
 * @param $strDateFrom
 * @param $strDateTo
 * @param string $duration
 * @param string $format
 * @return array
 * @throws Exception
 */
function create_date_range($strDateFrom, $strDateTo, string $duration, string $format = 'Y-m-d H:i:s')
{
    $aryRange = [];
    $from = new DateTime($strDateFrom);
    $to = new DateTime($strDateTo);
    $to->modify('+1 minute');
    $period = new DatePeriod($from, new DateInterval($duration), $to);
    foreach ($period as $key => $value) {
        $aryRange[] = $value->format($format);
    }

    return $aryRange;
}
