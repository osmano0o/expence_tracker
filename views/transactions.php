<?php
    require "../app/App.php";

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Transactions</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
            .green{
                color: green;
            }
            .red{
                color: red;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $calc = [];
                $minus = [];
                $plus = [];
                    for($cnt = count($array) ,$i = 0; $i< $cnt; $i++){
                        for($count = count($array[$i]), $b = 1; $b < $count-1; $b++){
                            echo "<tr>";
                            $exp = explode(",",$array[$i][$b],4);
                            for($count1 = count($exp), $j = 0; $j< $count1; $j++){
                                $exp[$j] = clean($exp[$j]);
                                if($j === 0){
                                    echo "<td>". date("M j, Y",strtotime($exp[$j])) . "</td>";
                                }elseif($j == 3){
                                    array_push($calc,numuric($exp[$j]));
                                    if((numuric(clean($exp[$j])) > 0)){
                                        echo "<td class='green'>". $exp[$j]. "</td>";
                                    }else{
                                        echo "<td class='red'>". $exp[$j]. "</td>";
                                    }
                                }
                                else{
                                    echo "<td>". $exp[$j]. "</td>";
                                }
                                
                                
    
                        }
                            echo "</tr>";
                            
                            
                        }
                    }
                    function clean(string $el):string{
                        return trim($el , chr(13)."\"" )  ;
                    }
                    function numuric($el){
                        return (float)str_replace(["$",","],["",""],$el);
                    }
                    // for($count = count($calc),$i=0; $i<$count;$i++){
                    //     $calc[$i] = numuric($calc[$i]);
                    // }
                        $minus = [];
                        $plus = [];
                        function divide(array $arr,&$plus,&$minus){

                            foreach($arr as $el){
                                if($el > 0)
                                array_push($plus,$el);
                                else
                                array_push($minus,$el);
                            }
                        }
                        divide($calc,$plus,$minus);
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td ><?= "$". array_sum($plus) ?></td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td ><?="-$". -(array_sum($minus)) ?></td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td><?="$".  array_sum($calc) ?></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
