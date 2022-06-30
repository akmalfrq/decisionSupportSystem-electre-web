<?php
function is_logged_in()
{
    $ci =& get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('login');
    } else {
        
    }
}

function selected($p1, $p2)
{
    if ($p1 == $p2) {
        return 'selected = "selected"';
    }
}

function hitung_electre($p1="")
{
    $ci =& get_instance();
    $ci->load->model('metode_model', 'metode');
    $pemohon = $ci->metode->get_pemohon();
    $nilai = $ci->metode->get_pemohon_nilai($ci->input->get('p'));
    if (empty($nilai->result_array())) {
        return ['kosong'=>true];
    }
    $kriteria = $ci->metode->get_kriteria();

    //Matrix keputusan
    $matrix = [];
    foreach ($nilai->result_array() as $k => $v) {
        $matrix[$v['id']][$v['id_kriteria']] = $v['nilai'];
    }

    //Menjumlahkan nilai kriteria alternatif setiap kriteria
    $x = [];
    foreach ($kriteria->result_array() as $key => $val) {
        $temp = 0;
        foreach ($pemohon->result_array() as $k => $v) {
            $temp+= pow($matrix[$v['id']][$val['id']], 2);
        }
        $x[$val['id']] =round(sqrt($temp),3);
    }

    //Matrix ternormalisasi & Pembobotan
    $matrix_r = [];
    $matrix_v = [];
    foreach ($kriteria->result_array() as $key => $val) {
        foreach ($pemohon->result_array() as $k => $v) {
            $matrix_r[$v['id']][$val['id']] = round($matrix[$v['id']][$val['id']]/$x[$val['id']],3);
            $matrix_v[$k+1][$key+1] = number_format(round($matrix_r[$v['id']][$val['id']]*$val['bobot'],3),3);
        }
    }    

    //Menentukkan himpunan Concordance & Discordance
    $c = [];
    $d = [];
    for ($i=1; $i <= count($pemohon->result_array()); $i++) { 
        for ($j=1; $j <= count($pemohon->result_array()); $j++) { 
            $c[$i][$j]=[];
            $d[$i][$j]=[];
            for ($k=1; $k <= count($kriteria->result_array()); $k++) { 
                if ($i==$j) {
                    $c[$i][$j][] = "-";
                    $d[$i][$j][] = "-";
                } else {
                    if ($matrix_v[$i][$k]>=$matrix_v[$j][$k]) {
                        $c[$i][$j][] = $k-1;
                    } elseif ($matrix_v[$i][$k]<$matrix_v[$j][$k]) {
                        $d[$i][$j][] = $k-1;
                    }
                }
            }
        }
    }

    $matrix_c = [];
    $matrix_d = [];
    $bobot = $ci->metode->get_bobot_kriteria()->result_array();

    //Matrix concordance
    foreach ($c as $key => $value) {
        foreach ($value as $k => $val) {
            $temp=0;
            foreach ($val as $x => $v) {
                if ($key==$k) {
                    $temp = "-";
                } else {
                    $temp+=$bobot[$v]['bobot'];
                }
            }
            $matrix_c[$key][$k] = $temp;
        }
    }

    //Thresold concordance
    $threshold_c = 0;
    foreach ($matrix_c as $key => $value) {
        foreach ($value as $k => $val) {
            if ($key!=$k) {
                $threshold_c += $val;
            }
        }
    }
    $threshold_c/=($pemohon->num_rows()*($pemohon->num_rows()-1));

    $matrix_f = [];
    foreach ($matrix_c as $key => $value) {
        foreach ($value as $k => $val) {
            if ($key!=$k) {
                if ($val>=$threshold_c) {
                    $matrix_f[$key][$k]=1;
                } else {
                    $matrix_f[$key][$k]=0;
                }
            } else {
                $matrix_f[$key][$k]="-";
            }
        }
    }    
// var_dump($d[2][1]);die;
    //Matrix discordance
    foreach ($d as $key => $value) {
        foreach ($value as $k => $val) {
            // echo $key." ".$k."<br>";
            $max=0;
            $max2=0;
            // echo $max2." ".$max."<br>";
            // var_dump($val);
            foreach ($val as $x => $v) {
                if ($key==$k) {
                    $matrix_d[$key][$k] = "-";
                } else {
                    // if (($v)<$kriteria->num_rows()) {
                        if ((abs($matrix_v[$key][$v+1]-$matrix_v[$k][$v+1]))>$max2) {
                            $max2=abs($matrix_v[$key][$v+1]-$matrix_v[$k][$v+1]);
                        }
                    // }
                        // echo $v." ";
                }
            }
            // echo "<br>";
            if ($key!=$k) {
                for ($i=1; $i <=$kriteria->num_rows(); $i++) {
                    // echo $matrix_v[$key][$i]."-".$matrix_v[$k][$i];
                    if ((abs($matrix_v[$key][$i]-$matrix_v[$k][$i]))>$max ) {
                        $max=abs($matrix_v[$key][$i]-$matrix_v[$k][$i]);
                    }
                    // echo "<br>";
                }
                // if($key==2 && $k==1){
                    // echo $max2."/".$max;
                    // echo "<br>----<br>";
                // }
                $matrix_d[$key][$k] = $max2/$max;
                if ($matrix_d[$key][$k]<1 && $matrix_d[$key][$k]>0) {
                    $matrix_d[$key][$k]=number_format($matrix_d[$key][$k],3);
                }
            }
        }
    }

    //Threshold discordance
    $threshold_d = 0;
    foreach ($matrix_d as $key => $value) {
        foreach ($value as $k => $val) {
            if ($key!=$k) {
                $threshold_d+=$val;
            }
        }
    }
    
    $threshold_d/=($pemohon->num_rows()*($pemohon->num_rows()-1));

    $matrix_g = [];
    foreach ($matrix_d as $key => $value) {
        foreach ($value as $k => $val) {
            if ($key!=$k) {
                if ($val>=$threshold_d) {
                    $matrix_g[$key][$k]=1;
                } else {
                    $matrix_g[$key][$k]=0;
                }
            } else {
                $matrix_g[$key][$k]="-";
            }
        }
    }

    // Agregat dominan matrix
    $matrix_e = [];
    for ($i=1; $i <= $pemohon->num_rows() ; $i++) { 
        for ($j=1; $j <= $pemohon->num_rows() ; $j++) { 
            if ($i==$j) {
                $matrix_e[$i][$j] = "-";
            } else {
                $matrix_e[$i][$j] = $matrix_f[$i][$j]*$matrix_g[$i][$j];
            }
        }
    }
    if ($p1=="report") {
        $obj = [
            'kosong'    => false,
            'report'  => $matrix_e
        ];
        return $obj;
    } else {
        $obj = [
            'kosong'    => false,
            'pemohon'   => $pemohon,
            'nilai'     => $nilai,
            'kriteria'  => $kriteria,
            'matrix'    => $matrix,
            'x'         => $x,
            'matrix_r'  => $matrix_r,
            'matrix_v'  => $matrix_v,
            'c'         => $c,
            'd'         => $d,
            'matrix_c'  => $matrix_c,
            'matrix_d'  => $matrix_d,
            'matrix_f'  => $matrix_f,
            'matrix_g'  => $matrix_g,
            'matrix_e'  => $matrix_e
        ];
    }

    return $obj;
}

function report_electre()
{
    $ci =& get_instance();    
    return hitung_electre('report');
}

// $data['pemohon'] = $ci->metode->get_pemohon();
// $data['nilai'] = $ci->metode->get_pemohon_nilai($ci->input->get('p'));
// $data['kriteria'] = $ci->metode->get_kriteria();

// //Membuat matrix nilai kriteria setiap alternatif
// $data['matrix'] = [];
// foreach ($data['nilai']->result_array() as $k => $v) {
//     $data['matrix'][$v['id']][$v['id_kriteria']] = $v['nilai'];
// }

// //Menjumlahkan nilai kriteria alternatif setiap kriteria
// $data['x'] = [];
// foreach ($data['kriteria']->result_array() as $key => $val) {
//     $temp = 0;
//     foreach ($data['pemohon']->result_array() as $k => $v) {
//         $temp+= pow($data['matrix'][$v['id']][$val['id']], 2);
//     }
//     $data['x'][$val['id']] =round(sqrt($temp),3);
// }

// //Matrix ternormalisasi & Pembobotan
// $data['matrix_r'] = [];
// $data['matrix_v'] = [];
// foreach ($data['kriteria']->result_array() as $key => $val) {
//     foreach ($data['pemohon']->result_array() as $k => $v) {
//         $data['matrix_r'][$v['id']][$val['id']] = round($data['matrix'][$v['id']][$val['id']]/$data['x'][$val['id']],3);
//         $data['matrix_v'][$k+1][$key+1] = number_format(round($data['matrix_r'][$v['id']][$val['id']]*$val['bobot'],3),3);
//     }
// }

// //Menentukkan himpunan Concordance & Discordance
// $data['c'] = [];
// $data['d'] = [];
// for ($i=1; $i <= count($data['pemohon']->result_array()); $i++) { 
//     for ($j=1; $j <= count($data['pemohon']->result_array()); $j++) { 
//         for ($k=1; $k <= count($data['kriteria']->result_array()); $k++) { 
//             if ($i==$j) {
//                 $data['c'][$i][$j][] = "-";
//                 $data['d'][$i][$j][] = "-";
//             } else {
//                 if ($data['matrix_v'][$i][$k]>$data['matrix_v'][$j][$k]) {
//                     $data['c'][$i][$j][] = $k-1;
//                 }
//                 if ($data['matrix_v'][$i][$k]<$data['matrix_v'][$j][$k]) {
//                     $data['d'][$i][$j][] = $k-1;
//                 }
//             }
//         }
//     }
// }

// $data['matrix_c'] = [];
// $data['matrix_d'] = [];
// $bobot = $ci->metode->get_bobot_kriteria()->result_array();

// //Matrix himpunan concordance
// foreach ($data['c'] as $key => $value) {
//     foreach ($value as $k => $val) {
//         $temp=0;
//         foreach ($val as $x => $v) {
//             if ($key==$k) {
//                 $temp = "-";
//             } else {
//                 $temp+=$bobot[$v]['bobot'];
//             }
//         }
//         $data['matrix_c'][$key][$k] = $temp;
//     }
// }

// //Thresold concordance
// $threshold_c = 0;
// foreach ($data['matrix_c'] as $key => $value) {
//     foreach ($value as $k => $c) {
//         if ($key!=$k) {
//             $threshold_c += $c;
//         }
//     }
// }
// $threshold_c/=($data['pemohon']->num_rows()*($data['pemohon']->num_rows()-1));

// $data['matrix_f'] = [];
// foreach ($data['matrix_c'] as $key => $value) {
//     foreach ($value as $k => $c) {
//         if ($key!=$k) {
//             if ($c>=$threshold_c) {
//                 $data['matrix_f'][$key][$k]=1;
//             } else {
//                 $data['matrix_f'][$key][$k]=0;
//             }
//         } else {
//             $data['matrix_f'][$key][$k]="-";
//         }
//     }
// }

// //Matrix himpunan discordance
// foreach ($data['d'] as $key => $value) {
//     $max=0;
//     foreach ($value as $k => $val) {
//         $max2=0;
//         foreach ($val as $x => $v) {
//             if ($key==$k) {
//                 $data['matrix_d'][$key][$k] = "-";
//             } else {
//                 if (($v+1)<$data['kriteria']->num_rows()) {
//                     if ((abs($data['matrix_v'][$key][$v+1]-$data['matrix_v'][$k][$v+1]))>$max2) {
//                         $max2=abs($data['matrix_v'][$key][$v+1]-$data['matrix_v'][$k][$v+1]);
//                     }
//                 }
//             }
//         }
//         if ($key!=$k) {
//             for ($i=1; $i <=$data['kriteria']->num_rows(); $i++) {
//                 if ((abs($data['matrix_v'][$key][$i]-$data['matrix_v'][$k][$i]))>$max ) {
//                     $max=abs($data['matrix_v'][$key][$i]-$data['matrix_v'][$k][$i]);
//                 }
//             }
//             $data['matrix_d'][$key][$k] = $max2/$max;
//             if ($data['matrix_d'][$key][$k]<1) {
//                 $data['matrix_d'][$key][$k]=number_format($data['matrix_d'][$key][$k],3);
//             }
//         }
//     }
// }

// //Threshold discordance
// $threshold_d = 0;
// foreach ($data['matrix_d'] as $key => $value) {
//     foreach ($value as $k => $d) {
//         if ($key!=$k) {
//             $threshold_d+=$d;
//         }
//     }
// }

// $threshold_d/=($data['pemohon']->num_rows()*($data['pemohon']->num_rows()-1));

// $data['matrix_g'] = [];
// foreach ($data['matrix_d'] as $key => $value) {
//     foreach ($value as $k => $d) {
//         if ($key!=$k) {
//             if ($d>=$threshold_d) {
//                 $data['matrix_g'][$key][$k]=1;
//             } else {
//                 $data['matrix_g'][$key][$k]=0;
//             }
//         } else {
//             $data['matrix_g'][$key][$k]="-";
//         }
//     }
// }

// // Agregat dominan matrix
// $data['matrix_e'] = [];
// for ($i=1; $i <= $data['pemohon']->num_rows() ; $i++) { 
//     for ($j=1; $j <= $data['pemohon']->num_rows() ; $j++) { 
//         if ($i==$j) {
//             $data['matrix_e'][$i][$j] = "-";
//         } else {
//             $data['matrix_e'][$i][$j] = $data['matrix_f'][$i][$j]*$data['matrix_g'][$i][$j];
//         }
//     }
// }