<?php

namespace App;

class MA_jk
{
    public $y;
    public $next_periode;
    public $n_periode;
    public $x;
    public $ft;
    public $xy;
    public $x_kuadrat;
    public $max_periode;

    function __construct($y, $next_periode, $n_periode, $q)
    {
        $this->y = $y;
        $this->next_periode = $next_periode;
        $this->q = $q;
        $this->n_periode = $n_periode;
        $this->hitung();
        $this->error();
    }

    function error()
    {
        $a = 1;
        foreach ($this->y as $key => $val) {
            if ($a > $this->n_periode) {
                $this->et[$key] = $this->ft[$key] - $val;
                $this->et_square[$key] = $this->et[$key] * $this->et[$key];
                $this->et_abs[$key] = abs($this->et[$key]);
                $this->et_yt[$key] = abs($this->et[$key] / $val);
                $this->et_p[$key] = $this->ft_p[$key] - $val;
                $this->et_square_p[$key] = $this->et_p[$key] * $this->et_p[$key];
                $this->et_abs_p[$key] = abs($this->et_p[$key]);
                $this->et_yt_p[$key] = abs($this->et_p[$key] / $val);
            }
            $a++;
        }
        $this->error['MSE'] = array_sum($this->et_square) / count($this->et_square);
        $this->error['RMSE'] = sqrt($this->error['MSE']);
        $this->error['MAE'] = array_sum($this->et_abs) / count($this->et_abs);
        $this->error['MAPE'] = array_sum($this->et_yt) / count($this->et_yt) * 100;
        $this->error['MSE_p'] = array_sum($this->et_square_p) / count($this->et_square_p);
        $this->error['RMSE_p'] = sqrt($this->error['MSE_p']);
        $this->error['MAE_p'] = array_sum($this->et_abs_p) / count($this->et_abs_p);
        $this->error['MAPE_p'] = array_sum($this->et_yt_p) / count($this->et_yt_p) * 100;
        //echo '<pre>' . print_r($this->error, 1) . '</pre>';
    }

    function hitung()
    {
        $prev = array();
        $k_temp = null;

        foreach ($this->y as $key => $val) {
            $hasil = 0;
            if (count($prev) == $this->n_periode) {
                $n = 0;
                foreach ($prev as $v) {
                    $hasil += $v;
                    $n++;
                }
                $hasil /= $n;
            }
            $this->ft[$key] = $hasil;
            $this->ft_p[$key] = $hasil;

            if($key == 'Semester 6'){
            if($this->ft[$key] != 0 ){
                $this->selisih[$key] =  $this->ft[$key] - $k_temp; 
                    if ($this->selisih[$key] > 0) {
                        if($this->q == 1) {
                            $this->ft_p[$key] = $this->ft[$key] + $this->selisih[$key];
                        }
                        
                        else {
                            $this->ft_p[$key] = $this->ft[$key] + (0.5 * $this->selisih[$key]);
                        }
                     }
                     
                     else {
                        if ($this->q == 1) {
                            $this->ft_p[$key] = $this->ft[$key] + (0.5 * $this->selisih[$key]);
                        }
                        
                        else {
                            $this->ft_p[$key] = $this->ft[$key] + $this->selisih[$key];
                        }
                     }
                }
            } else {
                $this->ft_p[$key] = $this->ft[$key];
            }
            
            
            $prev[] = $val;
            if (count($prev) > $this->n_periode){
                $prev = array_slice($prev, count($prev) - $this->n_periode, $this->n_periode);
            }
            
            $k_temp = $this->y[$key];
        }
        

        $this->max_periode = max(array_keys($this->y));

        for ($a = 1; $a <= $this->next_periode; $a++) {
            $hasil = 0;
            $n = 0;
            foreach ($prev as $v) {
                $hasil += $v;
                $n++;
            }
            $hasil /= $n;
            $key = 'Semester 7';
            $this->next_ft[$key] = $hasil;
            $this->selisih[$key] = $this->next_ft[$key] - $k_temp;
            if ($this->selisih[$key] > 0) {
                if($this->q == 1) {
                    $this->next_ft_p[$key] = $this->next_ft[$key] + $this->selisih[$key];
                }
                
                if($this->q == 2) {
                    $this->next_ft_p[$key] = $this->next_ft[$key] + (0.5 * $this->selisih[$key]);
                }
                
             }
             
             else {
                if($this->q == 1) {
                    $this->next_ft_p[$key] = $this->next_ft[$key] + (0.5 * $this->selisih[$key]);
                }
                
                if($this->q == 2) {
                    $this->next_ft_p[$key] = $this->next_ft[$key] + $this->selisih[$key];
                }
             }
            $prev[] = $hasil;
            if (count($prev) > $this->n_periode)
                $prev = array_slice($prev, count($prev) - $this->n_periode, $this->n_periode);
        }

        //echo '<pre>' . print_r($this, 1) . '</pre>';
    }
}