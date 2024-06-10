<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Array Task</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Play with Array</h1>
        <hr class="hr">

        <?php 
            echo "<h3>Looping Array range ( 2 - 10 ) with step 2</h3>";
            $arr=range(2,10,2);
            foreach ($arr as $value) {
                echo "<span>".$value."</span>";
            }

            echo "<hr><h3>Array operators'</h3>";
            $arr1 = [1,2,3,4,5];
            $arr2 = ['a','b','c','d','e'];
            $arr3 = $arr1 + $arr2;
            foreach ($arr3 as $v) {
                echo "<span>".$v."</span>";
            }

            echo "<hr><h3>Array Sorting ['c','a','e','b','d'];'</h3>";
            $sort=['c','a','e','b','d'];
            sort($sort);
            foreach ($sort as $va) {
                echo "<span>".$va."</span>";
            }

            echo "<hr><h3>Sorting Associative Arrays ['a' => 70,'b' => 25,'c' => 40];'</h3>";
            $assoc = [
                'a' => 70,
                'b' => 25,
                'c' => 40
            ];
            asort($assoc);
            foreach ($assoc as $key => $value) {
                echo "<span>$key => $value</span>"; 
            }

            echo "<hr><h3>Reverse Array [1,2,3,4,5]'</h3>";
            $rev = [1,2,3,4,5];
            $reversed = array_reverse($rev);
            foreach ($reversed as $value) {
                echo "<span>$value</span>";
            }

            echo "<hr><h3>Array flip ['a' => 1, 'b' => 2, 'c' => 3] </h3>";
            $flip = ['a' => 1, 'b' => 2, 'c' => 3];
            $flipped = array_flip($flip);
            foreach ($flipped as $key => $value) {
                echo "<span>$key => $value</span>";
            }

            echo "<hr><h3>Array navigation is a in ['a' => 1, 'b' => 2, 'c' => 3] </h3>";
            $nav = ['a' => 1, 'b' => 2, 'c' => 3];
            echo $nav['a'];

            echo "<hr><h3>Array merge ['a' => 1, 'b' => 2, 'c' => 3] and ['d' => 4, 'e' => 5, 'f' => 6]</h3>";
            $merge = ['a' => 1, 'b' => 2, 'c' => 3];
            $merge2 = ['d' => 4, 'e' => 5, 'f' => 6];
            $merged = array_merge($merge, $merge2);
            foreach ($merged as $key => $value) {
                echo "<span>$key => $value</span>";
            }

            echo "<hr><h3> array filter [1,90,2,null,3,'',55,[],5,6,7,8,'']</h3>";
            $filter = [1,90,2,null,3,'',55,[],5,6,7,8,''];
            $filtered = array_filter($filter);
            foreach ($filtered as $value) {
                echo "<span>$value</span>";
            }


        ?>
    </body>
</html>