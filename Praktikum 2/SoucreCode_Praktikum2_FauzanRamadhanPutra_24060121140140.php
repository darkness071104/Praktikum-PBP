<?php
    //Nama: Fauzan Ramadhan Putra
    //NIM: 24060121140140
    //Lab: PBP A1
    //Tanggal: Sabtu, 9 September 2023
    
    $array_mhs = array(
    'Abdul' => array( 89,90,54 ),
    'Budi' => array( 78,60,64 ),
    'Nina' => array( 67,56,84 ),
    'Budi' => array( 87,69,50 ),
    'Budi' => array( 98,65,74 )
    );

    function hitung_rata($array){
        $n = sizeof($array);
        $total = 0;
        for($i=0;$i<=($n-1);$i++){
            $total = $total + $array[$i];
        }
        $rata = $total / $n;
        return $rata;
    }

    function print_mhs($array_mhs){
        echo '<table border="1">';
        echo '<tr>
        <td>Nama</td>
        <td>Nilai 1</td>
        <td>Nilai 2</td>
        <td>Nilai 3</td>
        <td>Rata-rata</td>
        </tr>';
        foreach($array_mhs as $nama => $nilai){
            echo '<tr>';
            echo '<td>'.$nama.'</td>';
            $n = sizeof($nilai);
            for($i=0;$i<=($n-1);$i++){
                echo '<td>'.$nilai[$i].'</td>';
            }
            echo '<td>'.hitung_rata($nilai).'</td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    print_mhs($array_mhs);
?>