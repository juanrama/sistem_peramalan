<?php

namespace App;

class DES_sma
{
    // construct harus menerima q_sma, q_kab, q_jk dan tipe penghalusan
    function __construct($yt, $alpha, $n_periode, $q)
    {
        $this->yt = $yt;
        $this->alpha = $alpha;
        $this->n_periode = $n_periode;
        $this->q = $q;

        $this->hitung();
    }
    function hitung()
    {
        $a = 1;
        $st_temp = null;
        $sst_temp = null;
        $k_temp = null;
        foreach ($this->yt as $k => $v) {
            if ($a == 1) {
                $this->st[$k] = $v;
                $this->sst[$k] = $v;
                $this->at[$k] = $v;
                $this->bt[$k] = $this->alpha / (1 - $this->alpha) * ($this->st[$k] - $this->sst[$k]);
            } if ($a == 2) {
                $this->st[$k] = $this->alpha * $v + (1 - $this->alpha) * $st_temp;
                $this->sst[$k] = $this->alpha * $this->st[$k] + (1 - $this->alpha) * $sst_temp;
                $this->at[$k] = 2 * $this->st[$k] - $this->sst[$k];
                $this->bt[$k] = $this->alpha / (1 - $this->alpha) * ($this->st[$k] - $this->sst[$k]);
                $this->ft[$k] = $this->last_at + $this->last_bt;
                $this->e[$k] = $this->yt[$k] - $this->ft[$k];
                $this->e_abs[$k] = abs($this->e[$k]);
                $this->e2[$k] = pow($this->e[$k], 2);
                $this->e_abs_yt[$k] = abs($this->e[$k]) / $this->yt[$k];
            }
            if($a > 2) {
                $this->st[$k] = $this->alpha * $v + (1 - $this->alpha) * $st_temp;
                $this->sst[$k] = $this->alpha * $this->st[$k] + (1 - $this->alpha) * $sst_temp;
                $this->at[$k] = 2 * $this->st[$k] - $this->sst[$k];
                $this->bt[$k] = $this->alpha / (1 - $this->alpha) * ($this->st[$k] - $this->sst[$k]);
                $this->ft[$k] = $this->last_at + $this->last_bt;
                $this->e[$k] = $this->yt[$k] - $this->ft[$k];
                $this->e_abs[$k] = abs($this->e[$k]);
                $this->e2[$k] = pow($this->e[$k], 2);
                $this->e_abs_yt[$k] = abs($this->e[$k]) / $this->yt[$k];
                $this->selisih[$k] = $this->ft[$k] - $k_temp;
                 if ($this->selisih[$k] > 0) {
                    if($this->q == 1) {
                        $this->ft_p[$k] = $this->ft[$k] + $this->selisih[$k];
                    }
                    
                    if($this->q == 2) {
                        $this->ft_p[$k] = $this->ft[$k] + (0.75 * $this->selisih[$k]);
                    }

                    if($this->q == 3) {
                        $this->ft_p[$k] = $this->ft[$k] + (0.5 * $this->selisih[$k]);
                    }

                    if($this->q == 4) {
                        $this->ft_p[$k] = $this->ft[$k] + (0.25 * $this->selisih[$k]);
                    }
                 }
                 
                 else {
                    if($this->q == 1) {
                        $this->ft_p[$k] = $this->ft[$k] + (0.25 * $this->selisih[$k]);
                    }
                    
                    if($this->q == 2) {
                        $this->ft_p[$k] = $this->ft[$k] + (0.5 * $this->selisih[$k]);
                    }

                    if($this->q == 3) {
                        $this->ft_p[$k] = $this->ft[$k] + (0.75 * $this->selisih[$k]);
                    }

                    if($this->q == 4) {
                        $this->ft_p[$k] = $this->ft[$k] + $this->selisih[$k];
                    }
                 }

                $this->e_p[$k] = $this->yt[$k] - $this->ft_p[$k];
                $this->e_abs_p[$k] = abs($this->e_p[$k]);
                $this->e2_p[$k] = pow($this->e_p[$k], 2);
                $this->e_abs_yt_p[$k] = abs($this->e_p[$k]) / $this->yt[$k];
                
            }
            $this->last_at = $this->at[$k];
            $this->last_bt = $this->bt[$k];
            $st_temp = $this->st[$k];
            $sst_temp = $this->sst[$k];
            $k_temp = $this->yt[$k];
            $a++;
        }

        for ($a = 1; $a <= $this->n_periode; $a++) {
            $this->ft_next[] = $this->last_at + $this->last_bt * $a;
        }


        $this->mse = array_sum($this->e2) / count($this->e2);
        $this->rmse = sqrt(array_sum($this->e2) / count($this->e2));
        $this->mad = array_sum($this->e_abs) / count($this->e_abs);
        $this->mape = array_sum($this->e_abs_yt) / count($this->e_abs_yt) * 100;
        $this->mse_p = array_sum($this->e2_p) / count($this->e2_p);
        $this->rmse_p = sqrt(array_sum($this->e2_p) / count($this->e2_p));
        $this->mad_p = array_sum($this->e_abs_p) / count($this->e_abs_p);
        $this->mape_p = array_sum($this->e_abs_yt_p) / count($this->e_abs_yt_p) * 100;
    }
}
