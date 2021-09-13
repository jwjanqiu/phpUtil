<?php
/**
 * Created by PhpStorm
 * User: qiuyier
 * Date: 2021/9/13
 * TIME: 5:47 下午
 */

namespace Qiuyier\PhpUtil;

class Utils
{
    /**
     * 列表分页数据格式封装
     * @param int $total_num
     * @param int $current_page
     * @param int $page_size
     * @param array $data
     * @return array
     * @author Qiu
     */
    public function pageData(int $total_num = 0, int $current_page = 1, int $page_size = 10, array $data = []): array
    {
        return array(
            'Pagination' => array(
                'Total' => $total_num,
                'Page' => (int)$current_page,
                'PageSize' => (int)$page_size
            ),
            'Data' => $data
        );
    }

    /**
     * 截取多余字符以省略号返回
     * @param $text
     * @param $length
     * @return string
     * @author QiuYiEr
     */
    public function subtext($text, $length): string
    {
        if (mb_strlen($text, 'utf8') > $length) {
            return mb_substr($text, 0, $length, 'utf8') . '...';
        } else {
            return $text;
        }
    }

    /**
     * 价格计算
     * @param $n1
     * @param $symbol
     * @param $n2
     * @param string $scale
     * @return string
     * @author QiuYiEr
     */
    public function priceCalculate($n1, $symbol, $n2, string $scale = '2'): string
    {
        $res = "";
        switch ($symbol) {
            case "+"://加法
                $res = bcadd($n1, $n2, $scale);
                break;
            case "-"://减法
                $res = bcsub($n1, $n2, $scale);
                break;
            case "*"://乘法
                $res = bcmul($n1, $n2, $scale);
                break;
            case "/"://除法
                $res = bcdiv($n1, $n2, $scale);
                break;
            case "%"://求余、取模
                $res = bcmod($n1, $n2, $scale);
                break;
            default:
                $res = "";
                break;
        }
        return $res;
    }

    /**
     * 价格格式化
     * @param $price
     * @return string
     * @author QiuYiEr
     */
    public function priceFormat($price): string
    {
        return number_format($price, 2, '.', '');
    }

    /**
     * 价格由元转分
     * @param $price
     * @return int
     * @author QiuYiEr
     */
    public function priceYuan2fen($price): int
    {
        return (int)$this->priceCalculate(100, "*", $this->priceFormat($price));
    }

    /**
     * 随机验证码
     * @param int $length
     * @return int
     * @author QiuYiEr
     */
    public function generateRandomCode(int $length = 6): int
    {
        return rand(pow(10, ($length - 1)), pow(10, $length) - 1);
    }

    /**
     * 计算两个时间的差
     * @param $first_time
     * @param $second_time
     * @return array
     * @author QiuYiEr
     */
    public function computingTimeDifference($first_time, $second_time): array
    {
        if ($first_time > $second_time) {
            $start = $second_time;
            $end = $first_time;
        } else {
            $start = $first_time;
            $end = $second_time;
        }
        $time_diff = $end - $start;
        $date = intval($time_diff / 86400);
        $remain = $time_diff % 86400;
        $hour = intval($remain / 3600);
        $remain = $remain % 3600;
        $minute = intval($remain / 60);
        $second = $remain % 60;
        return array(
            'date' => abs($date),
            'hour' => abs($hour),
            'minute' => abs($minute),
            'second' => abs($second)
        );
    }

    /**
     * 通过身份证算年龄
     * @param $id_card
     * @return false|float|int|string
     * @author QiuYiEr
     */
    public function getAgeByID($id_card)
    {
        //过了这年的生日才算多了1周岁
        if (empty($id_card)) return '';
        $date = strtotime(substr($id_card, 6, 8));
        //获得出生年月日的时间戳
        $today = strtotime('today');
        //获得今日的时间戳
        $diff = floor(($today - $date) / 86400 / 365);
        //得到两个日期相差的大体年数

        //strtotime加上这个年数后得到那日的时间戳后与今日的时间戳相比
        return strtotime(substr($id_card, 6, 8) . ' +' . $diff . 'years') > $today ? ($diff + 1) : $diff;
    }

    /**
     * 获取毫秒级时间戳
     * @return int
     * @author QiuYiEr
     */
    public function getMsecTime(): int
    {
        list($msec, $sec) = explode(' ', microtime());
        return intval(((float)$msec + (float)$sec) * 1000);
    }

    /**
     * 信息脱敏
     * @param $string
     * @param int $start 开始位置
     * @param int $length 替换长度
     * @param string $re 替换字符
     * @return string
     * @author QiuYiEr
     */
    public function desensitize($string, int $start = 0, int $length = 0, string $re = '*'): string
    {
        if (empty($string) || empty($length) || empty($re)) {
            return $string;
        }
        $end = $start + $length;
        $str_len = mb_strlen($string);
        $str_arr = array();
        for ($i = 0; $i < $str_len; $i++) {
            if ($i >= $start && $i < $end) {
                $str_arr[] = $re;
            } else {
                $str_arr[] = mb_substr($string, $i, 1);
            }
        }
        return implode('', $str_arr);
    }
}